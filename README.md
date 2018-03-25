# vue-trust

[![Join the chat at https://gitter.im/vue-trust/Lobby](https://badges.gitter.im/vue-trust/Lobby.svg)](https://gitter.im/vue-trust/Lobby?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bantenprov/vue-trust/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bantenprov/vue-trust/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/bantenprov/vue-trust/badges/build.png?b=master)](https://scrutinizer-ci.com/g/bantenprov/vue-trust/build-status/master)
[![Latest Stable Version](https://poser.pugx.org/bantenprov/vue-trust/v/stable)](https://packagist.org/packages/bantenprov/vue-trust)
[![Total Downloads](https://poser.pugx.org/bantenprov/vue-trust/downloads)](https://packagist.org/packages/bantenprov/vue-trust)
[![Latest Unstable Version](https://poser.pugx.org/bantenprov/vue-trust/v/unstable)](https://packagist.org/packages/bantenprov/vue-trust)
[![License](https://poser.pugx.org/bantenprov/vue-trust/license)](https://packagist.org/packages/bantenprov/vue-trust)
[![Monthly Downloads](https://poser.pugx.org/bantenprov/vue-trust/d/monthly)](https://packagist.org/packages/bantenprov/vue-trust)
[![Daily Downloads](https://poser.pugx.org/bantenprov/vue-trust/d/daily)](https://packagist.org/packages/bantenprov/vue-trust)

Manage laravel permission using vuejs

## Install via composer 

```bash
$ composer require bantenprov/vue-trust:dev-master
```

## Edit config/app.php

```php

'providers' => [

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        
        //................
        
        Bantenprov\VueTrust\VueTrustServiceProvider::class,

```

## publish asset 

```bash
$ php artisan vendor:publish --tag=vue-trust-assets
```

## tambahkan pada resources/assets/js/routes/routes.js

```javascript

...authGuard([
  {
      path: '/admin',
      name: 'admin',
      redirect: '/admin/dashboard',
      component: layout('Default'),
      children: [
        //=== vue trust route
          {
            path: '/admin/vue-trust/role',
            components: {
              main: resolve => require(['~/components/bantenprov/vue-trust/role/role.index.vue'], resolve),
              navbar: resolve => require(['~/components/Navbar.vue'], resolve),
              sidebar: resolve => require(['~/components/Sidebar.vue'], resolve)
            },
            meta: {
              title: "Role"
            }
            },
            {
            path: '/admin/vue-trust/role/create',
            components: {
              main: resolve => require(['~/components/bantenprov/vue-trust/role/role.create.vue'], resolve),
              navbar: resolve => require(['~/components/Navbar.vue'], resolve),
              sidebar: resolve => require(['~/components/Sidebar.vue'], resolve)
            },
            meta: {
              title: "Role"
            }
            },
            {
              path: '/admin/vue-trust/role/:id/set-permission',
              components: {
                main: resolve => require(['~/components/bantenprov/vue-trust/role/role.setpermission.vue'], resolve),
                navbar: resolve => require(['~/components/Navbar.vue'], resolve),
                sidebar: resolve => require(['~/components/Sidebar.vue'], resolve)
              },
              meta: {
                title: "Role"
              }
            },
            {
              path: '/admin/vue-trust/role/:id/show',
              components: {
                main: resolve => require(['~/components/bantenprov/vue-trust/role/role.show.vue'], resolve),
                navbar: resolve => require(['~/components/Navbar.vue'], resolve),
                sidebar: resolve => require(['~/components/Sidebar.vue'], resolve)
              },
              meta: {
                title: "Role"
              }
            },
            {
            path: '/admin/vue-trust/role/:id/edit',
            components: {
              main: resolve => require(['~/components/bantenprov/vue-trust/role/role.edit.vue'], resolve),
              navbar: resolve => require(['~/components/Navbar.vue'], resolve),
              sidebar: resolve => require(['~/components/Sidebar.vue'], resolve)
            },
            meta: {
              title: "Role"
            }
          },
            {
            path: '/admin/vue-trust/permission',
            components: {
              main: resolve => require(['~/components/bantenprov/vue-trust/permission/permission.index.vue'], resolve),
              navbar: resolve => require(['~/components/Navbar.vue'], resolve),
              sidebar: resolve => require(['~/components/Sidebar.vue'], resolve)
            },
            meta: {
              title: "Permission"
            }
            },
            {
            path: '/admin/vue-trust/permission/create',
            components: {
              main: resolve => require(['~/components/bantenprov/vue-trust/permission/permission.create.vue'], resolve),
              navbar: resolve => require(['~/components/Navbar.vue'], resolve),
              sidebar: resolve => require(['~/components/Sidebar.vue'], resolve)
            },
            meta: {
              title: "Permission"
            }
            },
            {
            path: '/admin/vue-trust/permission/:id/show',
            components: {
              main: resolve => require(['~/components/bantenprov/vue-trust/permission/permission.show.vue'], resolve),
              navbar: resolve => require(['~/components/Navbar.vue'], resolve),
              sidebar: resolve => require(['~/components/Sidebar.vue'], resolve)
            },
            meta: {
              title: "Permission"
            }
            },
            {
            path: '/admin/vue-trust/permission/:id/edit',
            components: {
              main: resolve => require(['~/components/bantenprov/vue-trust/permission/permission.edit.vue'], resolve),
              navbar: resolve => require(['~/components/Navbar.vue'], resolve),
              sidebar: resolve => require(['~/components/Sidebar.vue'], resolve)
            },
            meta: {
              title: "Permission"
            }
          },
        //=== end vue trust route
```

## tambahkan pada resources/assets/js/app.js

```javascript
//.......
//== vue trust menus
import vuetrust_menu from './components/bantenprov/vue-trust/vuetrust_menu';
```

## run dev ( development )

```bash
$ npm run dev
```

## lanjutkan install laratrust
instalasi dan pengaturan laratust dapat dilihat <a href="http://laratrust.readthedocs.io/">disini</a>
