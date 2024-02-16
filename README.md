# Prueba Técnica Municipalidad De Merlo

![Banner](https://github.com/Maximiliano17/Prueba_Tecnica_Municipalidad_Merlo/raw/master/bannerMunicipalidad.jpg)

## ¿Qué es?

Este código es la resolución de una prueba técnica impuesta por la Municipalidad de Merlo. En esta prueba, se debía crear un sistema según mi criterio, incorporando las tecnologías que utilizan diariamente. El sistema creado es un área de trabajo que permite a los administradores (jefes) asignar tareas a sus empleados. Los empleados pueden completar las tareas asignadas y notificar a sus jefes una vez completadas.

## Tecnologías utilizadas:

<div align="left">
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" height="40" alt="html5 logo" />
  <img width="12" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" height="40" alt="css3 logo" />
  <img width="12" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" height="40" alt="javascript logo" />
  <img width="12" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" height="40" alt="php logo" />
  <img width="12" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" height="40" alt="mysql logo" />
  <img width="12" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/docker/docker-original.svg" height="40" alt="docker logo" />
</div>

# Vistas

## Registro

Una vista donde el administrador puede crear perfiles para los empleados, y si lo desea, también puede crear otros administradores.

![RegistroViewMuni](RegistroViewMuni.png)

## Invitados

Una vista donde los usuarios acceden a su cuenta, ya sean administradores o empleados.

![InvitadoViewMuni](InvitadoViewMuni.png)

## Crear Tareas

Una vista donde el administrador de la sala puede crear tareas y asignarlas a los empleados de su sala.

![CrearTareaViewMuni](CrearTareaViewMuni.png)

## Lista De Tareas

Una vista donde los empleados pueden visualizar todas las tareas que se les asignaron. Si el administrador accede, se mostrarán todas las tareas creadas. (Solo las tareas aún no completadas se mostrarán).

![ListaTareasViewMuni](ListaTareasViewMuni.png)

## Tareas completadas

En esta vista se mostrarán todas las tareas dadas por completadas.

![ListaTareasViewMuni](ListaTareasViewMuni.png)

## Buscador De Usuarios

Una vista donde el administrador de la sala puede ver a todos los usuarios que han accedido al sistema, ya sean administradores o empleados, y puede buscarlos por su nombre.

![SearchViewMuni](SearchViewMuni.png)

## Descarga La Base de Datos 😀

Puedes descargar la base de datos para utilizar el proyecto en caso de que no te funcione el docker.

### Estructura

La base de datos tiene las siguientes tablas:

- `Usuarios`: Una tabla con todos los usuarios existentes y sus roles.
- `Tareas`: Aquí se guardan las tareas de los usuarios.

### Instrucciones

1. Descarga la base de datos desde [enlace](https://drive.google.com/file/d/15dAdiYLIyVtHFa2oVN3_kdAjaZd_Qqpi/view?usp=sharing).
 
## Docker Instalacion 🐋

Antes de instalar y ejecutar este proyecto, asegúrate de tener instalados los siguientes requisitos:

- Docker: [Instrucciones de instalación de Docker](https://docs.docker.com/get-docker/)

## Cómo Instalar y Ejecutar

Siga estos pasos para instalar y ejecutar el proyecto utilizando Docker:

1. Clona este repositorio en tu máquina local:

   ```bash
   git clone https://github.com/Maximiliano17/Prueba_Tecnica_Municipalidad_Merlo.git

2. Navega a la carpeta del proyecto
     ```bash
   cd Prueba_Tecnica_Municipalidad_Merlo
3. Construye y levanta los contenedores de Docker utilizando Docker Compose:
      ```bash
   docker-compose up -d --build
4. Accede al juego a través de tu navegador web:
      ```bash
   http://localhost/5000
