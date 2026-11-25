@echo off
title Subir Cafeteria JJK a GitHub
cls
echo ================================================================
echo        SUBIR PROYECTO CAFETERIA JJK A GITHUB PARA RAILWAY
echo ================================================================
echo.
echo [1/4] Verificando instalacion de Git...
where git >nul 2>nul
if %errorlevel% neq 0 (
    echo.
    echo [AVISO] Git aun no esta instalado en tu computadora.
    echo Descarga el instalador oficial gratuito desde:
    echo   https://git-scm.com/download/win
    echo Instalalo dando 'Next' a todo y vuelve a ejecutar este archivo.
    echo.
    pause
    exit /b
)

echo [2/4] Inicializando repositorio Git local...
if not exist ".git" (
    git init
)

echo [3/4] Preparando archivos del proyecto...
git add .
git commit -m "Cafeteria JJK para despliegue en la nube Railway con Soft Delete y SSL"

echo.
echo ================================================================
echo Pega la URL de tu repositorio de GitHub que creaste
echo (Ejemplo: https://github.com/tu-usuario/cafeteria-jjk.git)
echo ================================================================
set /p REPO_URL="URL de tu GitHub: "

if "%REPO_URL%"=="" (
    echo No ingresaste ninguna URL. Operacion cancelada.
    pause
    exit /b
)

echo.
echo [4/4] Subiendo a GitHub...
git branch -M main
git remote remove origin 2>nul
git remote add origin %REPO_URL%
git push -u origin main

echo.
echo ================================================================
echo   PROYECTO SUBIDO CON EXITO A GITHUB!
echo   Ahora ve a https://railway.com y dale 'Deploy from GitHub repo'
echo ================================================================
echo.
pause
