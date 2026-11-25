# Manual de Implementación Técnica: Borrado Lógico (Soft Delete) y Certificado SSL (Let's Encrypt)
**Proyecto:** Cafetería Jujutsu Kaisen (`cafeteria-jjk`)  
**Servidor:** Apache (XAMPP) en Windows  
**Framework:** Laravel 11 / PHP 8.2+  
**Entidad Emisora SSL:** Let's Encrypt (CA Oficial Internacional)  

---

## 1. Arquitectura de Borrado Lógico (Soft Delete con Estado 0 y 1)

### 1.1 Objetivo del Requerimiento
Evitar la eliminación física definitiva de registros en la base de datos MySQL al presionar "Eliminar" en la interfaz de administración. Esto preserva la integridad referencial histórica (como pedidos y ventas asociadas) cambiando el estado del producto a inactivo (`0`), mientras que en la tienda pública únicamente se listan productos activos (`1`).

### 1.2 Estructura en la Base de Datos MySQL
En la tabla `productos` de la base de datos `cafeteria_jjk`, se incorporó la columna `activo`:
* **Tipo:** `TINYINT(1)`
* **Predeterminado:** `1` (Activo)
* **Valores posibles:** `1` = Visible y disponible para pedidos / `0` = Inactivo / Dado de baja.

```sql
ALTER TABLE `productos` ADD `activo` TINYINT(1) NOT NULL DEFAULT 1 AFTER `imagen`;
```

![Estructura de la tabla productos en phpMyAdmin](file:///C:/Users/HP/.gemini/antigravity/brain/7b4566bf-191f-4cb3-bbf7-0dea1b6748fd/img/01_phpmyadmin_soft_delete.png)

### 1.3 Archivos del Código Modificados

1. **Modelo `app/Models/Producto.php`**:
   * Se agregó `'activo'` dentro del atributo `$fillable` y se declaró su conversión a entero:
   ```php
   protected $fillable = [
       'nombre', 'descripcion', 'precio', 'categoria', 'imagen', 'activo',
   ];

   protected $casts = [
       'activo' => 'integer',
   ];
   ```

2. **Controlador `app/Http/Controllers/ProductoController.php`**:
   * En el método `destroy()`, se reemplazó la llamada destructiva `$producto->delete()` por una actualización de estado:
   ```php
   public function destroy(Producto $producto): RedirectResponse
   {
       $producto->update(['activo' => 0]);
       return redirect()->route('admin.productos.index')->with('ok', 'Producto desactivado (inactivo).');
   }

   public function activar(Producto $producto): RedirectResponse
   {
       $producto->update(['activo' => 1]);
       return redirect()->route('admin.productos.index')->with('ok', 'Producto reactivado.');
   }
   ```

3. **Rutas `routes/web.php`**:
   * En la consulta pública del menú (`/cafeteria`), se filtran únicamente los registros activos:
   ```php
   Route::get('/cafeteria', function () {
       $productos = Producto::where('activo', 1)->latest()->get();
       return view('cafeteria', compact('productos'));
   })->middleware('auth')->name('cafeteria');
   ```

4. **Validación de Carrito `app/Http/Controllers/CarritoController.php`**:
   * Se programó una regla de rechazo si un cliente intenta forzar la adición de un ítem inactivo:
   ```php
   if (!$producto->activo) {
       return back()->with('error', 'Este producto no está disponible.');
   }
   ```

---

## 2. Tramitación y Generación del Certificado SSL Oficial (Let's Encrypt)

Para dotar a la plataforma de cifrado HTTPS válido y reconocido por navegadores sin depender de túneles provisionales, se utilizó la Autoridad de Certificación **Let's Encrypt** mediante el protocolo **ACME**.

### Paso 1: Alta del Dominio Público en DuckDNS
* Se registró el subdominio gratuito **`cafeteria-jjk.duckdns.org`** vinculado a la cuenta `yayimantha.07@gmail.com`.
* Se generó el **Token de API** privado necesario para responder al desafío criptográfico `DNS-01`.

![Dominio configurado en DuckDNS](file:///C:/Users/HP/.gemini/antigravity/brain/7b4566bf-191f-4cb3-bbf7-0dea1b6748fd/img/02_duckdns_dominio.jpg)

### Paso 2: Creación del Repositorio Local de Certificados
* Se creó en el disco local `C:\` el directorio exacto: `C:\Certbot`
* Este directorio funciona como el contenedor seguro de las cadenas de certificados públicos y claves privadas en formato PEM.

![Carpeta Certbot creada en C](file:///C:/Users/HP/.gemini/antigravity/brain/7b4566bf-191f-4cb3-bbf7-0dea1b6748fd/img/03_carpeta_certbot.png)

### Paso 3: Descarga de la Herramienta ACME para Windows (`win-acme`)
* Desde el repositorio oficial de GitHub se descargó la versión oficial para Windows x64:
  `win-acme.v2.2.9.1701.x64.trimmed.zip`
* Se descomprimió y ubicó en `C:\win-acme` con el binario ejecutable `wacs.exe`.

![Descarga del binario win-acme en GitHub](file:///C:/Users/HP/.gemini/antigravity/brain/7b4566bf-191f-4cb3-bbf7-0dea1b6748fd/img/04_descarga_winacme.jpg)

---

## 3. Asistente Criptográfico con `wacs.exe`

### 3.1 Inicialización del Cliente ACME
Ejecución de `wacs.exe` desde la consola de Windows para establecer el canal seguro con los servidores de Let's Encrypt (`acme-v02.api.letsencrypt.org`):

![Ejecución inicial de wacs.exe](file:///C:/Users/HP/.gemini/antigravity/brain/7b4566bf-191f-4cb3-bbf7-0dea1b6748fd/img/05_wacs_inicio.jpg)

### 3.2 Parámetros del Certificado y Host
* **Opción `M`**: Create certificate (full options).
* **Opción `2`**: Manual input.
* **Host**: `cafeteria-jjk.duckdns.org`

![Configuración del host cafeteria-jjk.duckdns.org](file:///C:/Users/HP/.gemini/antigravity/brain/7b4566bf-191f-4cb3-bbf7-0dea1b6748fd/img/06_wacs_dominio.png)

### 3.3 Agrupación de Certificado
* **Opción `4`**: Single certificate (certificado único para el host).

![Selección de certificado único](file:///C:/Users/HP/.gemini/antigravity/brain/7b4566bf-191f-4cb3-bbf7-0dea1b6748fd/img/07_wacs_single_cert.jpg)

### 3.4 Desafío DNS y Algoritmo Criptográfico
* **Opción `6`**: `[dns] Create verification records manually` (demostración de propiedad de dominio vía registros DNS TXT).
* **Key type**: Algoritmo estándar **RSA 2048 bits**.

![Selección de DNS manual y clave RSA](file:///C:/Users/HP/.gemini/antigravity/brain/7b4566bf-191f-4cb3-bbf7-0dea1b6748fd/img/08_wacs_dns_rsa.jpg)

### 3.5 Almacenamiento en Formato PEM y Destino `C:\Certbot`
* **Store certificate**: Opción `2` (PEM encoded files - compatible con Apache/Nginx).
* **File path**: `C:\Certbot`.
* **Password for private key**: Ninguna (`None`).

![Configuración de ruta Certbot y formato PEM](file:///C:/Users/HP/.gemini/antigravity/brain/7b4566bf-191f-4cb3-bbf7-0dea1b6748fd/img/09_wacs_ruta_certbot.png)

### 3.6 Registro de Contacto y Términos de Servicio
* **Installation step**: Opción `3` (No additional installation steps).
* **Términos**: Aceptados (`y`).
* **Email de auditoría**: `yayimantha.07@gmail.com`.

![Registro de correo y acuerdos](file:///C:/Users/HP/.gemini/antigravity/brain/7b4566bf-191f-4cb3-bbf7-0dea1b6748fd/img/10_wacs_correo_terminos.jpg)

---

## 4. Validación Criptográfica del Desafío DNS-01

### 4.1 Inyección del Registro TXT en DuckDNS
Let's Encrypt solicitó la creación del registro:
* **Host:** `_acme-challenge.cafeteria-jjk.duckdns.org`
* **Contenido criptográfico:** `tEIZxNRl4A1kxqgwTPTYzWclUtkNvZGQm0mYN9nE5Cg`

Se realizó la actualización mediante la API HTTPS de DuckDNS:
```http
GET https://www.duckdns.org/update?domains=cafeteria-jjk&token=9364ec8e-bb02-406e-b6a6-a6a596165f63&txt=tEIZxNRl4A1kxqgwTPTYzWclUtkNvZGQm0mYN9nE5Cg
```
*Respuesta:* `OK`

### 4.2 Autorización Válida
Una vez propagado el registro en los servidores DNS internacionales, se ejecutó la comprobación (`1: Retry check`), obteniendo la certificación exitosa:
> `[cafeteria-jjk.duckdns.org] Authorization result: valid`

![Validación DNS autorizada con éxito](file:///C:/Users/HP/.gemini/antigravity/brain/7b4566bf-191f-4cb3-bbf7-0dea1b6748fd/img/11_wacs_validacion_exitosa.jpg)

### 4.3 Exportación de Certificados Oficiales
Se borró el registro TXT temporal y Let's Encrypt emitió y guardó los certificados en el disco local:
> `Exporting .pem files to C:\Certbot`

![Archivos PEM exportados correctamente a Certbot](file:///C:/Users/HP/.gemini/antigravity/brain/7b4566bf-191f-4cb3-bbf7-0dea1b6748fd/img/12_wacs_exportacion_pem.jpg)

**Archivos generados en `C:\Certbot`:**
1. `cafeteria-jjk.duckdns.org-chain.pem` *(Certificado público e intermedio CA)*
2. `cafeteria-jjk.duckdns.org-key.pem` *(Clave privada de 2048 bits)*

---

## 5. Configuración de Servidores: Apache (XAMPP), Windows y Laravel

### 5.1 Enlace del Certificado en Apache (`httpd-ssl.conf`)
En el archivo `C:\xampp\apache\conf\extra\httpd-ssl.conf` se definió el bloque de host virtual seguro para el puerto 443:

```apache
<VirtualHost *:443>
    DocumentRoot "C:/xampp/htdocs/cafeteria-jjk/public"
    ServerName cafeteria-jjk.duckdns.org
    SSLEngine on
    SSLCertificateFile "C:/Certbot/cafeteria-jjk.duckdns.org-chain.pem"
    SSLCertificateKeyFile "C:/Certbot/cafeteria-jjk.duckdns.org-key.pem"
    <Directory "C:/xampp/htdocs/cafeteria-jjk/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

### 5.2 Resolución Local en el Archivo `hosts` de Windows
Para que las peticiones al dominio apunten al servidor Apache de la máquina local, se agregó en `C:\Windows\System32\drivers\etc\hosts`:
```plaintext
127.0.0.1 cafeteria-jjk.duckdns.org
```

### 5.3 Configuración de Laravel para HTTPS Estricto
1. **`app/Providers/AppServiceProvider.php`**:
   ```php
   use Illuminate\Support\Facades\URL;

   public function boot(): void
   {
       if (app()->environment('local') || app()->environment('production')) {
           URL::forceScheme('https');
       }
   }
   ```
2. **`.env`**:
   ```env
   APP_URL=https://cafeteria-jjk.duckdns.org
   ```

---

## 6. Verificación en el Navegador con Cifrado Activo

Al ingresar a la URL **`https://cafeteria-jjk.duckdns.org`**, el servidor responde con el cifrado HTTPS completo:
* El tráfico viaja encriptado sin advertencias de seguridad.
* El navegador reconoce la firma criptográfica de **Let's Encrypt**.
* Se preserva el acceso seguro a todos los recursos (CSS, fuentes, imágenes y autenticación).

![Página de registro cargada bajo HTTPS con cifrado activo](file:///C:/Users/HP/.gemini/antigravity/brain/7b4566bf-191f-4cb3-bbf7-0dea1b6748fd/img/13_web_https.jpg)

---
*Fin del reporte técnico de implementación.*
