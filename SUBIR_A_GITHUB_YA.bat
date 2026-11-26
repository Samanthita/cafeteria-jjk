@echo off
title Subir Cafeteria JJK a GitHub
cls
echo ================================================================
echo        SUBIENDO PROYECTO CAFETERIA JJK A TU REPOSITORIO GITHUB
echo ================================================================
echo.
cd /d "C:\xampp\htdocs\cafeteria-jjk"
"C:\MinGit\cmd\git.exe" push -u origin main

echo.
echo ================================================================
if %errorlevel% equ 0 (
    echo   TODO SE SUBIO A GITHUB EXITOSAMENTE!
    echo   Ahora regresa a Railway y dale al boton "Deploy Repo".
) else (
    echo   Si te pidio iniciar sesion o token, ingresalo para terminar.
)
echo ================================================================
pause
