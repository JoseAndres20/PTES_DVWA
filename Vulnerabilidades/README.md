# 🔐 Vulnerabilidades Documentadas

## 📋 Descripción

Este directorio contiene la documentación completa de todas las vulnerabilidades explotadas en DVWA. Cada vulnerabilidad incluye su carpeta con imágenes de evidencia y payloads utilizados durante las pruebas.

---

## 📁 Estructura del Proyecto

```bash
VULNERABILIDADES/
│
├── BruteForce/
│   ├── bruteforce.md                 # Documentación completa
│   ├── img/                          # Evidencia visual
│   │   ├── login.png
│   │   ├── intercepcion.png
│   │   ├── intruder.png
│   │   ├── payload1.png
│   │   ├── payload2.png
│   │   └── resultados/
│   └── payloads/                     # Wordlists 
│       
│      
│
├── CommandInjection/
│   ├── comandinjection.md            # Documentación completa
│   ├── img/                          # Evidencia visual
│   │   ├── lugarvulnerabilidad.png
│   │   ├── resultado.png
│   │   └── resultado2.png
│   └── payloads/                     # Comandos 
│       
│
└── etc           # Demas Vulnerabilidades
        
```

---

## 🎯 Vulnerabilidades Analizadas

| # | Vulnerabilidad | Severidad | Documentación |
|---|----------------|-----------|---------------|
| 1 | **Brute Force** | 🟡 Media | [📄 Ver Documentación](./BruteForce/bruteforce.md) |
| 2 | **Command Injection** | 🔴 Crítica | [📄 Ver Documentación](./CommandInjection/comandinjection.md) |


---

## 📊 Leyenda de Severidad

| Icono | Nivel | Descripción |
|-------|-------|-------------|
| 🔴 | **Crítica** | Requiere atención inmediata |
| 🟠 | **Alta** | Riesgo elevado de compromiso |
| 🟡 | **Media** | Impacto moderado |
| 🟢 | **Baja** | Riesgo limitado |

---

## ⚠️ Nota Importante

Esta documentación es únicamente para **fines educativos**. Todas las pruebas fueron realizadas en un entorno de laboratorio controlado (DVWA).

**No usar estas técnicas en sistemas sin autorización explícita.**

---

<div align="center">

**🔒 Hack Responsibly | Learn Ethically**

</div>