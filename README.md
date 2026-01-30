# 🍗 Sistema de Gestión para Pollería (ERP)

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3.0-38B2AC?style=for-the-badge&logo=tailwind-css)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-15-336791?style=for-the-badge&logo=postgresql)

Sistema integral para la administración de restaurantes de comida rápida (pollerías), enfocado en el control de inventarios perecederos, recetas (escandallo) y gestión multi-sucursal.

## 🚀 Características Principales

### 🛡️ Roles y Seguridad
- **Super Admin (Dueño):** Acceso global a todas las sucursales, reportes financieros y gestión de personal.
- **Cajero:** Acceso limitado al Punto de Venta (POS) de su sucursal asignada.
- **Login Diferenciado:** Redirección inteligente según el rol del usuario.

### 🏪 Gestión Multi-Sucursal
- Creación y administración ilimitada de sucursales (Centro, Zona Sur, etc.).
- Asignación de personal específico por sucursal.
- Control de stock independiente por tienda.

### 📦 Inventario Avanzado & Recetas (Escandallo)
- **Gestión de Insumos:** Control de materia prima (Pollos crudos, Kilos de papa, Aceite).
- **Lotes y Vencimientos:** Sistema **FIFO** (First In, First Out) que prioriza la venta de productos próximos a vencer para reducir mermas.
- **Recetas Dinámicas:** Al vender un "1/4 de Pollo", el sistema descuenta automáticamente los ingredientes exactos (Ej: 0.25 Unidades de Pollo + 0.200 Kg de Papa).
- **Registro de Mermas:** Control de pérdidas por vencimiento o accidentes.

### 📱 Diseño UI/UX
- Interfaz completamente **Responsive** (adaptable a móviles y tablets).
- Desarrollado con **Tailwind CSS** para una estética moderna y limpia.

---

## 🛠️ Tecnologías Utilizadas

- **Backend:** Laravel 11 Framework.
- **Base de Datos:** PostgreSQL.
- **Frontend:** Blade Templates + Tailwind CSS (CDN).
- **Autenticación:** Sistema manual seguro con Hash y validaciones de Laravel.

