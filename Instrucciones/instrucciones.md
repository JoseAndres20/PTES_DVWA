# 🐳 Guía de Instalación de DVWA con Docker

> **DVWA** (Damn Vulnerable Web Application) es una aplicación web PHP/MySQL intencionalmente vulnerable para practicar seguridad web.

---

## 📋 Requisitos Previos

- Sistema operativo Linux Recomendado en Kali linux
- Acceso a terminal con privilegios sudo
- Conexión a internet

---

## 🚀 Proceso de Instalación

### 1️⃣ Instalar Docker

Primero, actualiza tu sistema e instala Docker:

```bash
sudo apt update
sudo apt install docker.io -y
sudo systemctl enable --now docker
```

**¿Qué hace este comando?**
- `apt update` → Actualiza la lista de paquetes disponibles
- `apt install docker.io -y` → Instala Docker automáticamente
- `systemctl enable --now docker` → Inicia Docker y lo configura para iniciar automáticamente

---

### 2️⃣ Descargar la Imagen Oficial de DVWA

Descarga la imagen desde Docker Hub:

```bash
docker pull vulnerables/web-dvwa
```

**Nota:** Este proceso puede tardar unos minutos dependiendo de tu conexión a internet.

---

### 3️⃣ Ejecutar el Contenedor

Inicia DVWA en el puerto 80:

```bash
docker run -d -p 80:80 vulnerables/web-dvwa
```

**Explicación de parámetros:**
- `-d` → Ejecuta el contenedor en segundo plano (detached mode)
- `-p 80:80` → Mapea el puerto 80 del contenedor al puerto 80 de tu máquina host

---

### 4️⃣ Acceder y Configurar DVWA

#### 🌐 Acceso Web

Abre tu navegador y accede a:

```
http://localhost
```

O si estás accediendo desde otra máquina:

```
http://IP_DE_TU_SERVIDOR
```

#### 🔐 Credenciales de Acceso

```
Usuario: admin
Password: password
```

#### ⚙️ Configuración de Seguridad

Una vez dentro de DVWA, configura el nivel de seguridad:

1. Ve al menú lateral izquierdo
2. Haz clic en **"DVWA Security"**
3. Selecciona el nivel deseado:

| Nivel | Descripción |
|-------|-------------|
| **Low** 🟢 | Sin protecciones. Vulnerabilidades fáciles de explotar. Ideal para principiantes. |
| **Medium** 🟡 | Protecciones básicas implementadas. Requiere técnicas intermedias. |
| **High** 🟠 | Protecciones avanzadas. Requiere conocimientos profundos de seguridad. |
| **Impossible** 🔴 | Código completamente seguro. Sin vulnerabilidades conocidas. |

4. Haz clic en **"Submit"** para aplicar los cambios

---

## 🛠️ Comandos Útiles de Docker

### Ver contenedores en ejecución
```bash
docker ps
```

### Detener el contenedor de DVWA
```bash
docker stop $(docker ps -q --filter ancestor=vulnerables/web-dvwa)
```

### Reiniciar el contenedor
```bash
docker restart $(docker ps -aq --filter ancestor=vulnerables/web-dvwa)
```

### Eliminar el contenedor
```bash
docker rm -f $(docker ps -aq --filter ancestor=vulnerables/web-dvwa)
```

### Ver logs del contenedor
```bash
docker logs $(docker ps -q --filter ancestor=vulnerables/web-dvwa)
```

---

## 🎯 Vulnerabilidades Disponibles en DVWA

DVWA incluye las siguientes categorías de vulnerabilidades para practicar:

- ✅ **Brute Force** - Ataques de fuerza bruta
- ✅ **Command Injection** - Inyección de comandos
- ✅ **CSRF** - Cross-Site Request Forgery
- ✅ **File Inclusion** - Inclusión de archivos (LFI/RFI)
- ✅ **File Upload** - Carga de archivos maliciosos
- ✅ **SQL Injection** - Inyección SQL
- ✅ **SQL Injection (Blind)** - Inyección SQL ciega
- ✅ **Weak Session IDs** - IDs de sesión débiles
- ✅ **XSS (DOM)** - Cross-Site Scripting basado en DOM
- ✅ **XSS (Reflected)** - Cross-Site Scripting reflejado
- ✅ **XSS (Stored)** - Cross-Site Scripting almacenado
- ✅ **CSP Bypass** - Bypass de Content Security Policy
- ✅ **JavaScript** - Vulnerabilidades en JavaScript

---

## ⚠️ Advertencias Importantes

> **🔒 SEGURIDAD**  
> DVWA es una aplicación **INTENCIONALMENTE VULNERABLE**. 
> - ❌ **NUNCA** la expongas a Internet
> - ❌ **NUNCA** la instales en un servidor de producción
> - ✅ Úsala **SOLO** en entornos de prueba aislados
> - ✅ Utilízala únicamente con fines educativos

> **📚 USO ÉTICO**  
> Esta herramienta es para aprendizaje de seguridad informática.
> - Solo practica en sistemas que tienes permiso para probar
> - El hacking sin autorización es ilegal

---

## 🎓 Recursos Adicionales

- 📖 [Documentación Oficial de DVWA](https://github.com/digininja/DVWA)
- 🐳 [Docker Hub - DVWA](https://hub.docker.com/r/vulnerables/web-dvwa)
- 🛡️ [OWASP Top 10](https://owasp.org/www-project-top-ten/)

---

## ✅ Verificación de Instalación

Para verificar que todo funciona correctamente:

1. ✅ Docker está ejecutándose: `sudo systemctl status docker`
2. ✅ El contenedor está activo: `docker ps`
3. ✅ DVWA responde en: `http://localhost`
4. ✅ Puedes iniciar sesión con las credenciales

---

**¡Listo! 🎉** Ya tienes DVWA instalado y configurado para comenzar a practicar técnicas de seguridad web de forma segura.