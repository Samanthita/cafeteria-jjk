@echo off
title ACTIVAR HOST MUNDIAL - CAFETERIA JJK
cls
echo ================================================================
echo      ACTIVANDO HOST EN LA NUBE (PARA CELULARES Y CUALQUIER DISPOSITIVO)
echo ================================================================
echo.
echo  Conectando con la red global segura de Cloudflare...
echo.
echo  IMPORTANTE:
echo  1. Deja esta ventanita abierta mientras quieras que este activa tu pagina.
echo  2. Busca abajo la linea que tiene el enlace terminado en:
echo     .trycloudflare.com
echo.
echo     Ejemplo:  https://algo-algo.trycloudflare.com
echo.
echo  Ese enlace HTTPS copialo, mandala por WhatsApp y abrelo en
echo  cualquier telefono, tablet o en la computadora del profesor!
echo ================================================================
echo.
"C:\xampp\cloudflared.exe" tunnel --url http://127.0.0.1:80
pause
