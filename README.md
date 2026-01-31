# Infinity Displays - Theme WordPress con WooCommerce

Theme limpio y liviano para tienda B2B de sistemas de displays y stands portátiles. Incluye sistema de precios por volumen (base, socio, preventa) y cotización vía WhatsApp.

**Versión:** 1.0.0
**Requiere:** WordPress 6.0+ | PHP 7.4+ | WooCommerce 8.0+
**Autor:** Infinity Displays
**Licencia:** GPL v2 o superior

---

## 📋 Tabla de Contenidos

1. [Características](#características)
2. [Requisitos](#requisitos)
3. [Instalación](#instalación)
4. [Configuración Inicial](#configuración-inicial)
5. [Importación de Productos](#importación-de-productos)
6. [Estructura del Theme](#estructura-del-theme)
7. [Personalización](#personalización)
8. [Precios por Volumen](#precios-por-volumen)
9. [Sistema de Roles](#sistema-de-roles)
10. [Soporte](#soporte)

---

## ✨ Características

### Funcionalidades Principales

- **✅ Sistema de Precios por Volumen**
  - Precio Base (1-5 unidades)
  - Precio Socio (6-23 unidades)
  - Precio Preventa (24+ unidades en embalaje completo)
  - Actualización dinámica en página de producto

- **✅ Integración con WhatsApp**
  - Botón de cotización en productos
  - Generación automática de mensajes con detalles del producto
  - Integración con carrito de compras

- **✅ Roles de Usuario**
  - Role "Socio Mayorista" para clientes B2B
  - Formulario de registro personalizado
  - Sistema de validación AJAX

- **✅ Diseño Responsive**
  - Mobile-first design
  - Optimizado con Tailwind CSS
  - Menú móvil interactivo

- **✅ SEO Optimizado**
  - Estructura semántica HTML5
  - Meta tags optimizados
  - Breadcrumbs integrados

- **✅ Sin Plugins Adicionales**
  - Todo integrado en el theme
  - Código limpio y optimizado
  - Carga rápida

---

## 📦 Requisitos

### Software Requerido

- **WordPress:** 6.0 o superior
- **PHP:** 7.4 o superior (se recomienda 8.0+)
- **MySQL:** 5.7 o superior / MariaDB 10.3+
- **WooCommerce:** 8.0 o superior

### Recomendaciones del Servidor

- **Memoria PHP:** Mínimo 256MB (recomendado 512MB)
- **Límite de ejecución:** 300 segundos
- **Tamaño máximo de upload:** 64MB
- **HTTPS:** Recomendado para pagos seguros

---

## 🚀 Instalación

### Paso 1: Descargar el Theme

```bash
cd wp-content/themes/
# Copiar la carpeta infinity-displays al directorio de themes
```

### Paso 2: Activar el Theme

1. Ir a **Apariencia > Temas** en el panel de WordPress
2. Buscar "Infinity Displays"
3. Hacer clic en **Activar**

### Paso 3: Instalar WooCommerce

Si WooCommerce no está instalado:

1. Ir a **Plugins > Añadir nuevo**
2. Buscar "WooCommerce"
3. Instalar y activar
4. Completar el asistente de configuración de WooCommerce

---

## ⚙️ Configuración Inicial

### 1. Configurar WooCommerce

**Moneda:**
- Ir a **WooCommerce > Ajustes > General**
- Moneda: **Peso Chileno (CLP)**
- Posición del símbolo: **$**
- Separador decimal: **,**
- Separador de miles: **.**

**Productos:**
- Ir a **WooCommerce > Ajustes > Productos**
- Página de la tienda: Crear o seleccionar
- Activar gestión de inventario
- Ocultar productos agotados: **No** (opcional)

**Impuestos:**
- Ir a **WooCommerce > Ajustes > Impuestos**
- Habilitar impuestos: **Sí**
- IVA (Chile): **19%**

### 2. Crear Páginas Necesarias

Crear las siguientes páginas:

**Página de Registro de Socios:**
1. **Páginas > Añadir nueva**
2. Título: "Registro de Socios"
3. Plantilla: **Registro de Socios** (en el panel lateral)
4. Publicar

**Configurar Menús:**
1. **Apariencia > Menús**
2. Crear menú "Menú Principal"
3. Agregar páginas:
   - Inicio
   - Tienda
   - Categorías de productos
   - Contacto
4. Asignar a "Menú Principal"

### 3. Subir Logo

1. **Apariencia > Personalizar > Identidad del sitio**
2. Subir logo (recomendado 200x60px, PNG con fondo transparente)
3. Guardar cambios

### 4. Configurar Imágenes de Productos

**Tamaños de imagen recomendados:**
- Imágenes de productos: 800x800px
- Miniaturas: 400x400px
- Formato: JPG (calidad 85%)

**Regenerar miniaturas:**
```bash
# Si es necesario, instalar plugin "Regenerate Thumbnails"
# O usar WP-CLI:
wp media regenerate --yes
```

---

## 📦 Importación de Productos

### Método 1: Importador CSV de WooCommerce

1. **WooCommerce > Productos > Importar**
2. Seleccionar archivo: `products-import.csv` (incluido en la raíz del theme)
3. Mapear columnas:
   - SKU → SKU
   - Name → Name
   - Short description → Short description
   - Categories → Categories
   - Stock → Stock
   - Regular price → Regular price
   - _retail_price → Meta: _retail_price
   - _wholesale_price → Meta: _wholesale_price
   - _bulk_price → Meta: _bulk_price
   - product_features → Meta: _product_features
4. Hacer clic en **Ejecutar importador**

### Método 2: Crear Productos Manualmente

**Crear un producto simple:**

1. **Productos > Añadir nuevo**
2. Completar información:
   - **Nombre:** Porta Pendón Económico 80×200
   - **SKU:** PP-ECO-80X200
   - **Descripción corta:** Roll-up económico...
   - **Categoría:** Porta Pendones
   - **Precio regular:** 35000

3. **Datos del producto > Precios:**
   - **Precio Base (1-5 unidades):** 35000
   - **Precio Socio (6-23 unidades):** 29000
   - **Precio Preventa (24+ unidades):** 25000

4. **Inventario:**
   - **Gestionar stock:** Sí
   - **Cantidad:** 500

5. **Características del Producto:**
   ```
   Montaje en 30 segundos
   Incluye bolso de transporte
   Gráfica intercambiable
   ```

6. **Imagen destacada:** Subir imagen del producto
7. **Publicar**

### Crear Categorías de Productos

1. **Productos > Categorías**
2. Crear las siguientes categorías:
   - Porta Pendones
   - Porta Pendones Mini
   - Panel Araña
   - Light Box
   - Counters
   - Banderas

---

## 📁 Estructura del Theme

```
infinity-displays/
│
├── assets/
│   ├── css/
│   │   └── main.css          # Estilos personalizados
│   ├── js/
│   │   └── main.js           # JavaScript principal
│   └── images/
│       └── *.jpg             # Imágenes del theme
│
├── inc/
│   ├── template-functions.php         # Funciones auxiliares
│   └── woocommerce-customizations.php # Customizaciones WooCommerce
│
├── woocommerce/
│   ├── archive-product.php   # Lista de productos
│   ├── single-product.php    # Detalle de producto
│   └── content-product.php   # Tarjeta de producto
│
├── functions.php             # Funciones del theme
├── header.php                # Header del sitio
├── footer.php                # Footer del sitio
├── index.php                 # Template principal
├── page.php                  # Template de páginas
├── page-registro-socio.php   # Registro de socios
├── style.css                 # Hoja de estilos principal
├── products-import.csv       # Archivo de importación
└── README.md                 # Esta documentación
```

---

## 🎨 Personalización

### Colores del Theme

Editar en `assets/css/main.css`:

```css
:root {
    --color-primary: #00A8CC;        /* Color principal (teal) */
    --color-secondary: #f3f4f6;      /* Gris claro */
    --color-accent: #10b981;         /* Verde */
    --color-destructive: #ef4444;    /* Rojo */
}
```

### Tipografía

El theme usa dos fuentes de Google Fonts:
- **Outfit:** Cuerpo de texto
- **Space Grotesk:** Títulos y headings

Para cambiar las fuentes, editar en `functions.php`:

```php
wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=TU_FUENTE&display=swap');
```

### Información de Contacto

Editar en `footer.php`:

```php
'Río de Janeiro 272, Recoleta'  // Dirección
'+56 9 4205 7591'                // Teléfono
'ventas@infinitydisplays.cl'    // Email
'77.121.104-6'                   // RUT
```

### WhatsApp

Cambiar número de WhatsApp en `functions.php`:

```php
function infinity_whatsapp_quote_link($phone = '+56942057591', $message = '')
```

---

## 💰 Precios por Volumen

### Cómo Funciona

El sistema de precios se basa en la cantidad total del producto en el carrito:

- **1-5 unidades:** Precio Base (Retail)
- **6-23 unidades:** Precio Socio (Wholesale)
- **24+ unidades:** Precio Preventa (Bulk/Embalaje completo)

### Configurar Precios

En cada producto, en la sección **Datos del producto**:

1. **Precio Base (1-5 unidades):** $35,000
2. **Precio Socio (6-23 unidades):** $29,000
3. **Precio Preventa (24+ unidades):** $25,000

### Actualización Dinámica

Los precios se actualizan automáticamente:
- ✅ Al cambiar la cantidad en la página del producto
- ✅ Al agregar productos al carrito
- ✅ En el checkout

---

## 👥 Sistema de Roles

### Role "Socio Mayorista"

El theme crea automáticamente un role "Socio" con permisos para:
- ✅ Comprar productos
- ✅ Ver precios de mayorista
- ✅ Acceder a descuentos por volumen

### Registro de Socios

**Formulario incluye:**
- Nombre completo
- Email
- Teléfono
- RUT
- Razón Social / Empresa
- Contraseña

**Validación:**
- AJAX en tiempo real
- Verificación de email único
- Validación de contraseñas coincidentes
- Formateo automático de RUT y teléfono

### Gestionar Socios

1. **Usuarios > Todos los usuarios**
2. Filtrar por role "Socio Mayorista"
3. Editar usuario para ver datos adicionales:
   - RUT
   - Empresa
   - Teléfono

---

## 🛠️ Desarrollo y Mantenimiento

### Modo Debug

Para desarrolladores, activar debug en `wp-config.php`:

```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
```

### Actualizar Tailwind CSS

El theme usa Tailwind CSS vía CDN para simplicidad. Para usar una build personalizada:

1. Instalar Tailwind:
```bash
npm install -D tailwindcss
npx tailwindcss init
```

2. Crear `tailwind.config.js`:
```js
module.exports = {
  content: ["./**/*.php"],
  theme: {
    extend: {
      colors: {
        primary: '#00A8CC',
      }
    }
  }
}
```

3. Build:
```bash
npx tailwindcss -i ./assets/css/tailwind.css -o ./assets/css/main.css --watch
```

### Optimización

**Cache:**
- Usar plugin de caché como WP Super Cache o W3 Total Cache
- Activar caché de objetos (Redis/Memcached)

**Imágenes:**
- Usar WebP en lugar de JPG
- Lazy loading automático incluido
- Comprimir imágenes antes de subir

**Base de datos:**
- Limpiar revisiones: `wp post delete $(wp post list --post_type='revision' --format=ids)`
- Optimizar tablas regularmente

---

## 📞 Soporte

### Documentación Adicional

- **WordPress Codex:** https://codex.wordpress.org/
- **WooCommerce Docs:** https://woocommerce.com/documentation/
- **Tailwind CSS:** https://tailwindcss.com/docs

### Contacto

**Infinity Displays**
Email: ventas@infinitydisplays.cl
Teléfono: +56 9 4205 7591
Dirección: Río de Janeiro 272, Recoleta, Santiago, Chile

---

## 📝 Changelog

### Versión 1.0.0 (2026-01-22)
- ✅ Lanzamiento inicial del theme
- ✅ Sistema de precios por volumen implementado
- ✅ Integración con WhatsApp
- ✅ Registro de socios mayoristas
- ✅ Templates personalizados de WooCommerce
- ✅ Diseño responsive con Tailwind CSS
- ✅ 25 productos de catálogo pre-configurados

---

## 📄 Licencia

Este theme está licenciado bajo GPL v2 o superior.

```
Copyright (C) 2026 Infinity Displays

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
```

---

**Hecho con ❤️ para Infinity Displays**
