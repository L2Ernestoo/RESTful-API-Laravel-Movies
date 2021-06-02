API para obtener informacion de series y peliculas de TheMovieDB


Ejemplos a utilizar de la api.
https://www.getpostman.com/collections/cded796e0fcd7269af06

Para generar una Token primero debe de registrarse el usuario de
desde esta url via POST /api/auth/signup via Post

con estos parametros via Raw
{
    "name": "Mi Nombre",
    "email": "MiCorreo@email.com",
    "password": "12345678"
}


Posteriormente mandar una peticion ala url para loguearse via POST /api/auth/login

{
    "email": "micorreo@email.com",
    "password": "12345678",
    "remember_me": true
}

Obtendra su "access_token" valido por una semana.

Este ya lo podra utilizar en las demas peticiones


[GET][Info Pelicula = api/movie/{id_movie}

[GET]Peliculas Populares = api/movie/popular

[POST]Crear Review = api/movie/{id_movie}/review 

[GET]Reviews Creadas = api/movie/{id_movie}/reviews


[GET]Info Series = api/tv/{id_tv_show}

[GET]Series Populares = api/tv/popular

[POST]Crear Review = api/tv/{id_tv_show}/review 

[GET]Reviews Creadas = api/tv/{id_tv_show}/reviews


Ejemplo Headers
{
    "Content-Type" : "application/json",
    "X-Requested-With" : "XMLHttpRequest",
    "Authorization" : "Bearer [Token]"
}