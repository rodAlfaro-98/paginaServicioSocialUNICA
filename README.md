# Servicio Social

## Instalación - Desarrollo



### Dependencias
* `npm`
* `node`
* `php`
* `composer`
* `docker`
---

1. Clonar repositorio

  ```sh
  git clone https://github.com/rodAlfaro-98/paginaServicioSocialUNICA.git
  cd servicio-social
  ```

2. Agrega el directorio `vendor` con `composer` (se puede obtener de manera externa copiando y pegando vendor/ de algún proyecto laravel)
  ```sh
   composer install
  ```

3. Instala los modulos de `npm`
  ```sh
  npm install
  ```
  
4. Crea las imágenes de docker por medio de artisan `sail`
  ```sh
  php artisan sail up
  ```
  
5. Configura el archivo de configuracion `.env`
  
6. Inicia los contenedores con `sail`
  ```sh
  ./vendor/bin/sail up
  ```
  _NOTA_: Agrega un alias para ejecutar solo ``sail`` y no la ruta completa ``./vendor/bin/sail up``
  
7. Ejecuta las migraciones
  ```sh
  sail artisan migrate:fresh --seed
  ```
  
8. Inicia el servidor de desarrollo de `vite`
  ```sh
  npm run dev
  ```
  * Si no se está realizando desarrollo front-end ejecuta `npm run build`

9. Para compilar estilos de sass, minificar imágenes y propositos en general de desarrollo front-end
  ```sh
  cd resources
  npm install
  npx gulp dev
  ```
  * Solo ejecutar npm install dentro de resources la primera vez



