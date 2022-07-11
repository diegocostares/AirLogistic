<p align="center">
  <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/84/Escudo_de_la_Pontificia_Universidad_Cat%C3%B3lica_de_Chile.svg/1200px-Escudo_de_la_Pontificia_Universidad_Cat%C3%B3lica_de_Chile.svg.png" width="120px">
  <img src="https://github.com/Dafnemami/BDDProyecto_g47/blob/main/Sites/assets/logo2.png?raw=true" height="120px">
    <h1 align="center">Grupos 47 y 74</h1>
    <h2 align="center">Bases de datos</h2>
</p>

## Integrantes

| Nombre                     | Email                  | Github                                                   |
| -------------------------- | ---------------------- | -------------------------------------------------------- |
| Diego Costa R. :100:       | diegocostar@uc.cl      | [@diegocostares](https://github.com/diegocostares)       |
| Marcos Fernández :monkey:  | marcos.fernandez@uc.cl | [@marcosfernandezr](https://github.com/marcosfernandezr) |
| Dafne Arriagada :red_car:  | dafne.arriagada@uc.cl  | [@Dafnemami](https://github.com/Dafnemami)               |
| Valentina Campaña :cactus: | valentinacamph@uc.cl   | [@aerotecnia99 ](https://github.com/aerotecnia99)        |

## Visualizacion en web :eyes:

La app está disponible en el siguiente [link](https://codd.ing.puc.cl/~grupo47).

## Contraseñas login :lock:

Para acceder directamente a esto se debe clickear en el botón _'Importar Usuarios'_ en la barra superior de navegación (Se recomienda una visualización al 90% para una mejor visualización :smile:). En dicha página, para la comodidad de quien este revisando, se han dispuesto todos los usuarios importados, en conjunto con sus credenciales y otros datos relevantes que exponen mejor el proceso y su resultado.

Es importante señalar, que presionar el botón implica que el procedimiento almacenado denominado `importar_usuarios.sql` se ejecuta y la tabla usuarios, que se asume previamente creada _(Segun [issue#301](https://github.com/IIC2413/Syllabus-2022-1/issues/331); desde la bdd con `"\i usuarios.sql"`, disponible en la carpeta Entrega3)_, se pobla verificando alguna preexistencia de los usuarios de cada tipo. Donde, de verificar alguna existencia, no vuelve a poblar la tabla, lo cual lo pueden checkear clickeando nuevamente sobre el botón _'Importar Usuarios'_ viendo que les vuelven a aparecer las mismas credenciales.

### Sobre la asignación de contraseñas :key:

Esto ocurre en el procedimiento almacenado importar_usuarios.sql ubicado en la carpeta Entrega3, el cual fue importado y ejecutado en la base de datos "grupo47e3".

- Pasajeros: Usuario tipo "pasajero". Para hacer esto se utilizó la función random_pswd_pasajeros del archivo `random_pswd_pasajeros.sql`, ubicado en carpeta Entrega3, quien a su vez llama a la función random_between del archivo `random_int.sql`, para obtener un largo aleatorio y así obtener un substring del nombre del pasajero y del pasaporte del pasajero a quien la función random_pswd_pasajeros recibe como input. Además, para este último se utiliza la misma función para obtener una posición aleatoria de la cual se produce el substring.

  Subsiguientemente, se obtiene un número aleatorio de 3 cifras también con random_between, para finalmente, formar la contraseña concatenando el substring del nombre más el substring del pasaporte más el número de 3 cifras.

- Compañias: Usuario tipo "compania". Para hacer esto se hizo uso de la función random_between del archivo `random_int.sql`, también ubicado en la carpeta Entrega3, que retorna un número aleatorio entre los números que le son entregados como input. Se decidió entregar como input 100000000 y 999999999, por lo que la contraseña del usuario de este siempre tiene largo 9.

Respecto a como se solicita esta explicación en el enuncuado, se asumió que _personal administrativo_ hace referencia a usuarios tipo _compania_ y _usuarios preexisentes_ a _pasajero_.

<vieja sapa jjj :two_men_holding_hands:>

## Funcionalidades adicionales :love_letter:

- En la vista de las compañías de vuelo se visualiza un grafico dona realizado con [Canvasjs](https://canvasjs.com/php-charts/), que contiene un promedio de los vuelos aprobados y rechazados segun la compañía con la que se esta logeado. _(Se recomienda iniciar con el usuario **ADC**)._ La visualizacion esta en `company.php` y se llama a la querie `tasa_aprobacion.php`, la cual tiene una consulta para determinar el numero aprobado y otra para el numero de rechazados _(valores con los cuales se realiza el grafico)_. Esta funcionalidad le entrega valor al usuario ya que representa de manera visual una posible metrica para la compañia de vuelo.

- En la vista de los usuarios tambien se puede visualizar un grafico (construido con la misma libreria de Canvasjs) que representa con un grafico de barras el top 8 ciudades mas visitadas. La visualizacion esta en `passager.php` y se llama a la querie `destinos_fav.php`, la cual tiene una consulta para determinar el numero de visitas por cada ciudad.

- Se intentó realizar un manejo de errores personalizado mediante la creación de vistas para los errores 400, 401, 403, 404, 406, 422, 500. Estas vistas se encuentran en la carpeta `Sites/views/errors`, y se pueden ver en el siguiente [link](https://codd.ing.puc.cl/~grupo47/Sites/views/errors/bad_request.php). Esto se intentó configurar con el archivo `.htaccess`, pero no se logró debido a las configuraciones predeterminadas del servidor del curso. Sin embargo, en caso de que se hubiera creado un servidor propio, funcionaria.

## Suposiciones y aclaraciones útiles para la corrección :speech_balloon:

En general, creemos haber implementado una navegación eficiente, fluida e intuitiva, por lo que consideramos que no es necesario reparar o hacer enfasis en algún funcionamiento o pasos a seguir en particular para acceder a algun página o ejecutar algún proceso.

### Importar Usuarios :busts_in_silhouette:

En nuestro caso no tuvimos problemas en la creación de usuario alguno. Si bien en la rúbrica se pide avisar en caso de tener problemas, decidimos también avisar en pantalla en la en página de usuarios importados (`usuarios_importados.php`) cuando todos los usuarios, es decir de los tres tipos, son creados correctamente.

### Sobre la denominación del tipo de cada usuario en entidad usuarios :card_index:

- Admin: Se sigue lo señalado en el enunciado ("Admin DGAC")
- Compañia Aérea: Queda como "compania"
- Pasajeros: Queda como "pasajero"

### Sobre archivos .sql en carpeta Entrega3 :file_folder:

- `usuarios.sql`: crea tabla usuarios en base de datos grupo 47.
- `random_int.sql`: crea un número aleatorio entre los números entregados como input
- `random_pswd_pasajeros.sql`: se explica en sección _"Sobre la asignación de contraseñas a > Pasajeros"_
- `importar_usuarios.sql`: Procedimiento almacenado que crea los usuarios de cada tipo, verificando previamente su existencia. Es decir, si existen, no los vuelve a crear. Para más detalle ver sección _"Contraseñas login"_
- `verify_passport.sql`: Busca verificar si el pasaporte existe en la base de datos. Notar que para verificar si no se entrega ningún pasaporte en algún campo de texto esta función lo identifica revisando si la variable pasaporte es 'bieja', lo cual se asignó en reservar.php para manejar de alguna manera alternativa los strings vacios luego de tener problemas en un inicio con su manejo.
- `verify_flights.sql`: Busca verificar si el vuelo existe en la base de datos. Se consideraron dos casos: Primero, el nuevo vuelo, ya sea su fecha de llegada o salida, está entre las fechas de llegada y salida de algún vuelo pre-existente.(estos son los primeros dos "(Condicion 1 AND Condicion 2)"). Segundo, el nuevo vuelo, es decir su fecha de llegada y salida, contiene entre medio a algún vuelo pre-existente.
- `reserva.sql`: Procedimiento almacenado que genera la reserva.

El orden anterior se basa en lo señalado como válido en la [issue#321](https://github.com/IIC2413/Syllabus-2022-1/issues/321)

### Sobre manejo de bases de datos en Admin :bar_chart:

Las propuestas de vuelo que observa el **Admin** provienen de la base de datos par, específicamente de la tabla **propuestas**. Al aceptar alguna de ellas al hacer click en su checkbox se pedirá una confirmación. Esta confirmación implica crear un **vuelo** en la base de datos impar, cuyos datos serán obtenidos de las relaciones de la bdd del grupo 74.

### Sobre la navegación :pushpin:

- `company.php`: En vez de mostrar las dos tablas de vuelos aprobados y rechazados encontramos que era mas intuitivo mostrar unos botones que desplieguen las tablas respectivas. Asi, en primera instancia, se puede visualizar el grafico de donas con la tasa de aprobación de los vuelos. Luego, si es de interés, se puede revisar las tablas especficias.

- `passenger.php`: Se recomienda probar el usuario V03976673 _(Para tener mas datos)_. A partir de una ciudad de origen, destino y fecha de despegue se muestran los vuelos. Luego, para clickear un vuelo se debe presionar el radio-button de la fila correspondiente y se desplegará el form para ingresar los pasaportes para efectuar una reserva.

  Es importante señalar que los datos mostrados de los vuelos, una vez ya especificados los campos de ciudad de origen, destino y fecha de despegue, se limitan a lo que se consideró que sería útil ver para el usuario. Es por dicha razón que datos como el `id` del vuelo no son visibles.

### Sobre la funcionalidad "generar reserva"

- La verificación de los pasaportes se ejecuta al llamar `verify_passport()` desde `reserva.sql`, este asigna un valor de 1 si el pasaporte se encuentra en la base de datos (del grupo impar) y 0 en otro caso. En caso de tener un string vacio, caso en que reserva.sql asigna la variable "bieja" a dicho valor, retorna 3. Es importante notar que `reserva.sql` ocupa la función mencionada sobre cada uno de los pasaportes ingresados.

- La verificación del tope de horario de vuelos se ejecuta al llamar `verify_flight()` desde `reserva.sql`, este igualmente asigna un valor de 0 si el vuelo tiene tope de horario y un valor de 1 si no lo hay.

- En `reserva.sql` se crea una tabla con todos los campos de texto asignados y se va verificando uno a uno su admisibilidad para efectuar una reserva. Si todos los pasaportes son admisibles, se efectuará la reserva. Sin embargo, esto no alcanzó a ser bien implementado para actualizar correctamente la base de datos. 

- `reserva.sql` retorna una tabla con 4 columnas (id, pasaporte, ok_pasaporte, ok_horario) 
  - Cuando `ok_pasaport` y `ok_horario` son iguales a 1 debería haberse efectuado la reserva, pero, el trozo de código desde la línea 84 no actualiza estos cambios.  

- Si bien no se logró implementar completamente, la visión era la siguiente:
    - No se ejecuta la reserva a menos que todos y cada uno de los pasaportes ingresados sean válidos, es decir, en el caso de ingresar 3 pasaportes con 2 válidos + 1 inválido la reserva no se llevara a cabo y por lo tanto la base de datos no será modificada.

    - A su vez, la reserva se ejecutara si y solo todos y cada une de les usuaries no presenta topes temporales con otros vuelos



# Checklist rúbrica E3
_Esto lo incluimos para ayudar al ayudante corrector y para mantener un buen flujo de desarrollo._
```
❌ : NO implementado
✅ : Implementado
🟠 : Implementado a medias
❓ : Depende del ayudante
```

* **(18 pts) Usuarios y Login**
    * **(6 pts) Login:**
        - ✅ (1 pto) Tipo DGAC 
        - ✅ (1 pto) Tipo Pasajero
        - ✅ (1 pto) Tipo Aerolinea
        - ✅ (1 pto) Campos necesarios
        - ✅ (2 ptos) Manejo de cierre de sesión.

    * **(12 pts total) Importación de usuarios:** 
        - ✅ (1 pto) Tipo de archivo correspondiente
        - ✅ (1 pts) Crea el tipo DGAC y verifica si es que el usuario ya existe
        - ✅ (2 pts) Crear usuarios del tipo compañía aérea y verifica
        - ✅ (1 pto) Crear contraseñas _aleatorias_ a los usuarios del tipo compañía aerea.
        - ✅ (2 pts) Crear usuarios del tipo pasajero y verifica
        - ✅ (2 pts) Agrega una contraseña a los usuarios de tipo pasajero
        - ✅ (2 pts) En caso de que no se puedan importar un usuario se muestra un mensaje
        - ✅ (1 pto) Accede a la funcion desde la pagina principal.

* **(30 pts) Información personal y Navegación:**
    * **(15 pts) Usuario DGAC:**
        - ✅ (1 pto) Vista principal:
        - ✅ (4 pts) Listado de propuestas de vuelo:
        - ✅ (6 pts) Aceptación/Rechazo de propuestas:
        - ✅ (4 pts) Filtro por fecha:
    * **(5 pts) Usuario Compañía aérea:**
        - ✅ (3pts) Vista principal:
        - ✅ (2pts) Listas de vuelos
    * **(10 pts) Usuario Pasajero**
        - ✅ (4 pts) Vista principal
        - ✅ (3 pts) Página/Sección de búsqueda de vuelos:
        - ✅ (3 pts) Sección de vuelo:
        - ✅ Función de reserva:

* **(22 pts) Procedimiento Almacenado:** 
    * 🟠 (8 pts) Definición de archivos
    * 🟠 (14 pts) Funcionamiento web

* **✅ (5 pts) Funcionalidad Adicional:** 

* ❓**Bonus (hasta 5 décimas) Por navegación sobresaliente:** 