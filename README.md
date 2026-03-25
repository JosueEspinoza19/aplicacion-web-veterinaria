# Sistema de Gestión de Citas para Veterinaria 

Este proyecto es una aplicación web local simple desarrollada para la materia de **Aplicaciones Web** en la **Universidad Autónoma de Baja California (UABC)**, Facultad de Ciencias Químicas e Ingeniería.

El sistema permite gestion basica del flujo de una clínica veterinaria, incluyendo el registro de dueños, mascotas y la programación de citas médicas.

## Características Principales

* **Operaciones CRUD Completas:** Control total (Crear, Leer, Actualizar, Eliminar) en los tres módulos principales: Dueños, Mascotas y Citas.
* **Validaciones:** Implementación de validaciones en PHP para asegurar la integridad de los datos (formatos de teléfono, nombres y fechas).
* **Interfaz Intuitiva:** Menú principal con acceso diferenciado por módulos y tablas de visualización ordenadas.
* **Relaciones en Base de Datos:** Vinculación lógica entre dueños y mascotas mediante llaves foráneas.

## Tecnologías Utilizadas

* **Lenguaje:** PHP.
* **Base de Datos:** MySQL.
* **Entorno de Desarrollo:** XAMPP (Apache y MySQL).
* **Diseño:** HTML5 y CSS3.

## Estructura del Proyecto

El proyecto está organizado de manera modular:

* `/citas`: Lógica para agendar y modificar consultas.
* `/css`: Archivos de estilos independientes para cada módulo.
* `/db`: Configuración de conexión y script SQL de la base de datos.
* `/duenos`: Gestión de información de contacto de clientes.
* `/imagenes`: Contenido grafico(iconos).
* `/mascotas`: Administración del inventario de mascotas y sus vínculos.

## Instalación y Configuración

1.  **Clonar el repositorio** dentro de la carpeta `htdocs` de tu instalación de XAMPP.
2.  **Importar la Base de Datos:**
    * Acceder a `phpMyAdmin`.
    * Crear una base de datos llamada `veterinaria`.
    * Importar el archivo `db/db_veterinaria.sql`.
3.  **Configurar Conexión:**
    * Revisar el archivo `db/conexion.php` y ajustar las credenciales de host, usuario y contraseña si es necesario.
4.  **Ejecución:**
    * Abrir el navegador y dirigirse a `http://localhost/AW_ProyectoFinal/index.php`.
  
## Ejecucion del proyecto

**Menu Principal**

<img width="1875" height="837" alt="image" src="https://github.com/user-attachments/assets/c95541ae-2903-47ec-912f-0f43ce7f5234" />

**Gestion de dueños**
<img width="1874" height="615" alt="image" src="https://github.com/user-attachments/assets/dc9751b0-c031-443a-b913-0186fedaa4d7" />

**Gestion de mascotas**
<img width="1873" height="537" alt="image" src="https://github.com/user-attachments/assets/eea686e5-f32d-4d21-90ae-472c38179aa3" />

**Gestion de citas**
<img width="1872" height="467" alt="image" src="https://github.com/user-attachments/assets/a1b4fefa-3bff-4707-82af-13f1fa319059" />

