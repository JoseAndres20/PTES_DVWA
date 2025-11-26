# 🔒 Informe Técnico de Seguridad (PTES)

**Proyecto**: DVWA Pentest  
**Metodología**: [PTES (Penetration Testing Execution Standard)](http://www.pentest-standard.org/)  
**Fecha**: Noviembre 2025  

---

## 1. Pre-engagement Interactions (Interacciones Previas)

*   **Alcance**: Aplicación web DVWA alojada en entorno local.
*   **Objetivo**: Identificar vulnerabilidades explotables en el nivel de dificultad "Media".
*   **Tipo de Prueba**: Caja Gris (Grey Box).

---

## 2. Intelligence Gathering (Recolección de Información)

En esta fase se realizó el mapeo de la superficie de ataque, enumeración de directorios y detección de tecnologías.

> 📄 **Ver Detalle de Reconocimiento**: [Reconocimiento y Enumeración](../reconosimiento/reconocimiento.md)

**Resumen de Actividades**:
*   Escaneo de puertos y servicios.
*   Enumeración de directorios con `gobuster` y `dirsearch`.
*   Identificación de puntos de entrada (login, formularios).

---

## 3. Threat Modeling (Modelado de Amenazas)

*   **Activos Críticos**: Base de datos de usuarios, sistema de archivos del servidor, credenciales administrativas.
*   **Agentes de Amenaza**: Atacantes externos no autenticados, usuarios maliciosos internos.

---

## 4. Vulnerability Analysis & Exploitation (Análisis y Explotación)

Se identificaron y explotaron exitosamente las siguientes vulnerabilidades. Para ver la **evidencia técnica completa, payloads utilizados, capturas de pantalla y pasos de reproducción**, por favor haga clic en el enlace de "Documentación Técnica" correspondiente.

### 4.1. Command Injection (Inyección de Comandos)
*   **Severidad**: 🔴 **Crítica** (CVSS 9.6)
*   **Descripción**: Ejecución arbitraria de comandos del sistema operativo a través del filtrado insuficiente en la función de "Ping".
*   **Prueba de Concepto**: Ejecución de `ls`, `pwd` y `cat /etc/passwd`.
*   👉 **[Ver Documentación Técnica Completa](../Vulnerabilidades/CommandInjection/comandinjection.md)**

### 4.2. SQL Injection (Inyección SQL)
*   **Severidad**: 🔴 **Crítica** (CVSS 9.8)
*   **Descripción**: Manipulación de consultas SQL a través del parámetro `id`, permitiendo la extracción completa de la base de datos.
*   **Prueba de Concepto**: Uso de `UNION SELECT` para extraer usuarios y hashes de contraseñas.
*   👉 **[Ver Documentación Técnica Completa](../Vulnerabilidades/sqlinjection/sqlinjection.md)**

### 4.3. File Upload (Subida de Archivos Arbitrarios)
*   **Severidad**: 🔴 **Crítica** (CVSS 9.8)
*   **Descripción**: Bypass de validación de tipo de archivo (MIME type) permitiendo la subida de scripts PHP maliciosos.
*   **Prueba de Concepto**: Subida de una **Reverse Shell** y obtención de acceso remoto al servidor.
*   👉 **[Ver Documentación Técnica Completa](../Vulnerabilidades/FileUpload/fileupload.md)**

### 4.4. Stored XSS (Cross-Site Scripting Almacenado)
*   **Severidad**: 🟠 **Alta** (CVSS 7.1)
*   **Descripción**: Inyección de código JavaScript persistente en el libro de visitas (Guestbook).
*   **Prueba de Concepto**: Bypass de limitación de caracteres y ejecución de `alert()` o robo de cookies.
*   👉 **[Ver Documentación Técnica Completa](../Vulnerabilidades/XSS(Stored)/xss.md)**

### 4.5. Brute Force (Fuerza Bruta)
*   **Severidad**: 🟡 **Media** (CVSS 6.5)
*   **Descripción**: Ausencia de mecanismos de bloqueo o limitación de tasa (rate limiting) en el login.
*   **Prueba de Concepto**: Descubrimiento de credenciales válidas usando diccionarios comunes.
*   👉 **[Ver Documentación Técnica Completa](../Vulnerabilidades/BruteForce/bruteforce.md)**

---

## 5. Post Exploitation (Post-Explotación)

Tras la explotación exitosa (especialmente mediante *Command Injection* y *File Upload*), se confirmó la capacidad de:
*   **Persistencia**: Crear usuarios o backdoors en el sistema.
*   **Exfiltración**: Leer archivos sensibles como `/etc/passwd` o configuraciones de la base de datos.
*   **Pivoting**: El servidor comprometido podría usarse como salto para atacar la red interna.

---

## 6. Reporting (Reporte y Recomendaciones)

Este documento sirve como índice maestro de los hallazgos técnicos. Se recomienda encarecidamente revisar cada archivo vinculado para implementar las correcciones específicas de código sugeridas en cada sección.

**Resumen de Remediación General**:
1.  **Validación de Entrada**: Implementar "Whitelisting" estricto para todos los inputs de usuario.
2.  **Consultas Parametrizadas**: Usar Prepared Statements para todas las consultas a base de datos.
3.  **Principio de Mínimo Privilegio**: Ejecutar servicios web con usuarios de bajos privilegios y permisos de sistema de archivos restringidos.

