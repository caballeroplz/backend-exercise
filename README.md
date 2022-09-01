# Ejercicio de entrevista técnica

## Contexto

Gran parte de nuestro trabajo es hacer la vida más fácil a nuestros compañeros
que hacen aplicaciones (web o nativas). Para ello creamos APIs obteniendo
datos de terceros o propios.

Para este ejercicio tenemos que ayudar a nuestros compañeros a hacer una
aplicación de búsqueda y listado. 

## Especificaciones

Necesitamos construir un API de cervezas que combinen con cierto tipo de comida. Para obtener los datos de las cervezas se utilizará la API de [PunkApi].

Las aplicacion debe tener estos dos endpoints:

- Busqueda mediante una cadena de caracteres. (El campo a filtrar será **food**)
- Mostrar los datos de una cerveza especifica según el id especificado.

La solución del ejercicio debe ser enviada en un repositorio de GitHub, GitLab o Bitbucket con el historial completo de git.

# Requisitos

La aplicación debe cumplir estos requisitos:

- Usar Symfony como Framework
- Debe ser un API REST y tener JSON como formato de salida.
- Los campos a mostrar serán: id, name, tagline, first_brewed, descrition, image
- Debe estar construida en Arquitectura Hexagonal y DDD
- La aplicación debe cumplir los estandares [PSR-2]
- Se deben construir test unitarios sin atacar al API ( Mockear PunkAPI )

## Extras

Como mejora de la aplicación puedes implementar las siguientes funcionalidades.

- Cachear las peticiones a PunkAPI temporalmente mediante FileSystem o Redis
- Construir documentacion del API mediante OpenAPI. Puedes usar [NelmioAPIBundle] u otra librería para ello.
- Crear test funcionales mediante Behat 


[PunkApi]: https://punkapi.com/documentation/v2
[NelmioAPIBundle]: https://symfony.com/bundles/NelmioApiDocBundle/current/index.html
[PSR-2]: http://www.php-fig.org/psr/psr-2/
