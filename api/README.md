## Install
* `composer install`
* `php artisan key:generate`
* `php artisan migrate` | `php artisan migrate:fresh`
* `php artisan db:seed`
* `php artisan optimize:clear`
* `npm install`

## Add tailwindcss
* `npm install -D tailwindcss@latest postcss@latest autoprefixer@latest`
* `npx tailwindcss init` - generate your tailwind.config.js
* add `require("tailwindcss")` in webpack.mix.js file. it should look like this:
```js
mix.js('resources/js/app.js', 'public/js')
  .postCss('resources/css/app.css', 'public/css', [
    require("tailwindcss"),
  ]);
```

* Add the paths to all of your template files in your tailwind.config.js file.
```js
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
```

* Add the @tailwind directives for each of Tailwind’s layers to your ./resources/css/app.css file
```css
@tailwind base;
@tailwind components;
@tailwind utilities
```
* Run your build process with `npm run watch`

## Add Vue.js 
* `npm install vue`
* `npm install vue-template-compiler`
* `npm install vue-loader`
* add in webpack.mix.js file `.vue` to mix.js()

or

* composer require laravel/ui
* php artisan ui vue
* see more here https://github.com/laravel/ui

## Others useful commands
* `php artisan make:model < name >`, optional add `-m` to create migration table 
* `composer dump-autoload`
* `composer update --prefer-dist`
