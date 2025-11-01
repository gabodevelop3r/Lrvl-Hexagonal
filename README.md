# 🔐 Guía de Configuración de Variables de Entorno

Este proyecto utiliza un archivo `.env` para manejar credenciales y configuraciones sensibles.  
Sigue los pasos a continuación para generar las claves necesarias y asegurar que tu entorno funcione correctamente.

---

## 🚀 Configuración paso a paso

### 1️⃣ Crear el archivo `.env`
Copia el archivo de ejemplo incluido en el repositorio y renómbralo:

```bash
cp .env.example .env
```

Luego abre el archivo `.env` y completa los valores según esta guía.

---

### 2️⃣ Generar las claves necesarias

#### 🔹 API_KEY
Clave única utilizada para autenticar solicitudes internas o servicios externos.  
Debe ser una cadena tipo UUID (identificador único universal).

**Comandos para generarla:**
```bash
# Opción 1 (Linux / macOS)
uuidgen

# Opción 2 (PHP)
php -r "echo uuid_create(UUID_TYPE_RANDOM);"
```

**Ejemplo:**
```
API_KEY=3f82dee6-c96b-4e20-a80e-50f2f21887e1
```

---

#### 🔹 APP_VERSION
Define la versión actual de la API.  
Se utiliza normalmente para versionar endpoints o despliegues.

**Ejemplo:**
```
APP_VERSION=v1
```

---

#### 🔹 JWT_KEY
Clave secreta utilizada para **firmar y verificar los tokens JWT**.  
Debe ser **larga, segura y privada**.  
⚠️ **Nunca compartas ni subas esta clave al repositorio.**

**Comandos para generarla:**

```bash
# Opción 1 (recomendada) - OpenSSL
openssl rand -hex 32

# Opción 2 - PHP
php -r "echo bin2hex(random_bytes(32));"

```

**Ejemplo:**
```
JWT_KEY=14768d4e7ae04715a3b9f9f0c5ba5ef5c9d5f7b8d2d1e0f6a8c3d2b1a7e4c6f2
```

> 💡 Recomendación: genera una clave distinta para cada entorno (`.env.local`, `.env.staging`, `.env.production`).

---

#### 🔹 JWT_ENCRYPT
Algoritmo utilizado para firmar el token JWT.  
Debe coincidir exactamente con el configurado en tu backend.

**Algoritmos comunes:**
- `HS256` → SHA-256 (rápido y seguro, recomendado)
- `HS384` → SHA-384
- `HS512` → SHA-512 (más seguro, más pesado)

**Ejemplo:**
```
JWT_ENCRYPT=HS256
```

---

### 3️⃣ Verificar tu configuración JWT (opcional)

Puedes probar tu configuración usando [https://jwt.io](https://jwt.io):

1. Abre el sitio y selecciona el algoritmo que definiste en `JWT_ENCRYPT`.  
2. En el **payload**, escribe algo como:
   ```json
   {
     "sub": 1,
     "name": "Test User",
     "iat": 1730400000
   }
   ```
3. En **VERIFY SIGNATURE**, pega tu `JWT_KEY`.  
4. Verifica que el token se valide correctamente.

---


### 5️⃣ Resumen rápido de generación

| Variable        | Comando recomendado                                | Ejemplo de valor |
|------------------|----------------------------------------------------|------------------|
| **API_KEY**      | `uuidgen`                                          | `3f82dee6-c96b-4e20-a80e-50f2f21887e1` |
| **JWT_KEY**      | `openssl rand -hex 32`                             | `14768d4e7ae04715a3b9f9f0c5ba5ef5c9d5f7b8d2d1e0f6a8c3d2b1a7e4c6f2` |
| **JWT_ENCRYPT**  | (definido manualmente)                             | `HS256` |
| **APP_VERSION**  | (definido manualmente)                             | `v1` |

---

📘 Con estos pasos tendrás tu entorno seguro, documentado y funcionando correctamente.
