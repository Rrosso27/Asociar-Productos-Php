## Estructura del Proyecto
  ~~~bash  
  Asociar-Productos-Php/
  ├── app/                   # Esta carpeta contiene la lógica principal del backend del proyecto.
  │   ├── controllers/       #Contiene los controladores que manejan las solicitudes HTTP 
  │   ├── models/            #Contiene las clases que interactúan con la base de datos
  │   ├── validations/       #Contiene las clases que validan los datos
  │   ├── messages/          #Contiene clases o archivos que gestionan los mensajes de error, éxito
  ├── public/                #Esta carpeta contiene los archivos públicos accesibles desde el navegador
  ├── views/                 #Esta carpeta contiene las vistas del proyecto
  │   ├── groups/            #Contiene las vistas relacionadas con los grupos
  │   ├── layout/            #Contiene las plantillas comunes que se reutilizan en varias vistas
  ├── docker/                #Esta carpeta contiene los archivos necesarios para configurar el entorno Docker.
  │   ├── php/               #Contiene el Dockerfile para configurar el contenedor PHP.
  │   ├── apache/            #Contiene el archivo de configuración de Apache
  ├── .env.example
  ├── docker-compose.yml
  └── index.php
  ~~~
## Get Started 🚀  
  ![App Screenshot](https://raw.githubusercontent.com/Rrosso27/Asociar-Productos-Php/refs/heads/main/public/img/Screenshot%202025-04-15%20233026.png)  
  Esta es la pestaña principal, que consta de tres recuadros. El primer recuadro es para registrar los productos: contiene un listado de los productos registrados 
  y un botón con la opción de agregar más productos. El segundo recuadro incluye todo lo necesario para registrar los grupos.
   El tercer recuadro contiene las opciones necesarias para asignar un producto a un grupo.
## Productos  
  listado de Productos
  ![App Screenshot](https://raw.githubusercontent.com/Rrosso27/Asociar-Productos-Php/refs/heads/main/public/img/Screenshot%202025-04-15%20233118.png)
  Formulario agregar producto:
  En este formulario, todos los campos son obligatorios. Si falla la validación, se indicará el error mediante una alerta roja en la parte superior del formulario
  ![App Screenshot](https://raw.githubusercontent.com/Rrosso27/Asociar-Productos-Php/refs/heads/main/public/img/image.png)
## Grupos 
  Listado de grupos 
  ![App Screenshot](https://raw.githubusercontent.com/Rrosso27/Asociar-Productos-Php/refs/heads/main/public/img/Screenshot%202025-04-15%20233224.png)
  Formulario de registro de grupos: todos los campos son obligatorios.  
  ![App Screenshot](https://github.com/Rrosso27/Asociar-Productos-Php/blob/main/public/img/Screenshot%202025-04-15%20233244.png?raw=true)

# Asignaciones 📝  
  Encargada de gestionar las relaciones entre grupos y productos. En la parte superior del proyecto se encuentra la opción para asignar un producto. En este formulario, todos los campos son obligatorios. En la parte inferior del formulario, está la opción que permite filtrar los productos por grupos.
  ![App Screenshot](https://raw.githubusercontent.com/Rrosso27/Asociar-Productos-Php/refs/heads/main/public/img/Screenshot%202025-04-15%20233333.png)
# Construir y ejecutar los contenedores 
  Ejecuta los siguientes comandos en la raíz de tu proyecto para construir y ejecutar los contenedores:
  ~~~bash  
  docker-compose build
  docker-compose up -d
  ~~~
# Acceder a tu aplicación
  ~~~bash  
  Abre tu navegador y accede a http://localhost:8000 para ver tu aplicación.
  ~~~
  ~~~bash  
  La base de datos estará disponible en el puerto 3306 (puedes usar herramientas como phpMyAdmin o MySQL Workbench para conectarte).
  ~~~
# Verificar los contenedores
  Cuando termines de trabajar, puedes detener los contenedores con:
  ~~~bash  
  docker ps
  ~~~
# Detener los contenedores
  Cuando termines de trabajar, puedes detener los contenedores con:
  ~~~bash  
  docker-compose down
  ~~~


