# Flujo de trabajo


Las ramas que se deben utilizar para realizar el proyecto son de tres tipos:

1. **`main`**  Es la rama principal en la que el proyecto ***completamente
   testeado*** y ***listo para subir*** será almacenado. Se debe evitar hacer
   modificaciones a esta rama para no tener conflictos o romper el proyecto.
2. **`develop`** Es la rama en la que sea subiran todos los cambios (merges y
   pull request a github) y tambien en la que se hará todo el testeo. Como solo
   es una rama, el merge a `main` no tendrá conflictos (si se evita
   correctamente modificar `main`).
3. **`feature`** Cada vez que se deba añadir una nueva funcionalidad, el
   desarrollador asignado debe crear una rama específica para esa tarea. En
   esta rama podrá realizar sus propios commits de manera independiente. Una
   vez terminada la funcionalidad, deberá hacer un `merge` hacia `develop`.

---

# Pasos iniciales

Despues de añadir los colaboradores del proyecto desde github, cada uno de los
colaboradores  deben de seguir los siguientes pasos:

### 1. Clonar/copiar el repositorio a su equipo local

```bash 
git clone https://github.com/Santhurt/Gleams 
```

Este comando crea una carpeta con todos los archivos del proyecto. 

### 2. Verificar las ramas existes

```bash 
git branch -a 
```

En caso de que no aparezcan las ramas del repositorio, se verifican si
estan en las ramas remotas:

```bash
git branch -r
```

Si se encuentran, se puede seguir con el siguiente paso.

### 3. Cambiar a la rama `develop`

```bash 
git checkout develop 
```

### 4. Crear una nueva rama segun la funcionalidad

```bash
git checkout -b feature_name 
```

Cuando se ejecuta este comando se cambia directamente a la nueva rama, para
cambiar de rama se ejecuta `git checkout branch_name`

---

# Guardar y subir los cambios

Una vez terminada la nueva funcionalidad o correcion del codigo, se siguen
estos pasos:

### 1. Cambiar a la rama `develop` y actualizarla

Cambiamos a la rama `develop`

```bash 
git checkout develop 
```

Luego actualizamos la rama:

```bash 
git pull origin develop 
```

De esta forma se descargan los ultimos cambios realizados en la rama de
desarrollo `develop`

### 2. Realizar el `merge`

Cambiamos nuevamente a la rama que queremos añadir (la de nuestra
funcionalidad)

```bash 
git checkout feature_name 
```

Luego hacemos un merge con la rama `develop`

```bash 
git merge develop 
```

Este merge lo que hace es ***Actualizar*** nuestra rama `feature` con lo que
haya en `develop`.

Si `develop` no tiene nuevos cambios (commits) desde que se creo la rama
`feature`, el merge indicará  que no hay actualizaciones para aplicar, en cuyo
caso la rama `feature` estará lista para hacer *pull request*

Por otro lado, si hay nuevos cambios en la rama `develop` (alguien añadió una
funcionalidad anteriormente) entonces pueden suceder dos cosas: 

1. **Sin conflictos:** Los cambios se realizaron en archivos o lineas
   diferentes, en ese caso el merge se completará automaticamente.
2. **Con conflictos:** Los cambios fueron realizados en el mismo lugar, en ese
   caso git mostrara que hay conflictos al realizar el merge.


En caso de conflictos, git insertará ambas versiones del codigo en el editor, a
partir de ahi se debe de modificar manualmente el codigo y decidir que cambios
se quieren conservar. 

> ***Nota:*** *Si por cualquier razon se prefiere cancelar el merge y dejar el
> codigo a como estaba antes, se puede ejecutar:*

```bash 
git merge --abort 
```

### 3. Terminar el proceso

Una vez que se hayan resuelto los conflictos (si los hubo), se realiza un
***nuevo commit*** para completar el merge, y la rama estará lista para un pull
request.

```bash 
git add . git commit -m "Mensaje de commit resolviendo conflictos" 
```

--- # Abrir un pull request

Por ultimo, hacemos un push para subir la rama al repositorio en github. Se
ejecuta el comando:

```bash 
git push -u origin feature 
```

Luego vamos al repostitorio en github, y nos aparecera un mensaje para realizar
el pull request:

[Imagen
1](https://miro.medium.com/v2/resize:fit:1400/format:webp/1*kaW2pkUlWGRXAfV8SgbriQ.png)

Al hacer esto, se abrira una seccion en la que se podrá dejar una descripcion
con los cambios. Tambien se puede seleccionar cual es el reviewer que se
encargará de revisar el codigo y aceptar el pull request

[Imagen
2](https://miro.medium.com/v2/resize:fit:1400/format:webp/1*uildE3NOi5GUzV9Ua_US-Q.png)


Despues de esto solo queda revisar el codigo, y decidiir si se acepta para la
aplicacion principal o requiere de cambios. 

> ***Nota final:*** *Recordar no editar o modificar la rama principal `main`,
> para que asi el merge de `develop` hacia `main` se haga sin conflictos*
