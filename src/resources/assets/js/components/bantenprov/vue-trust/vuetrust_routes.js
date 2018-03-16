import routes from '../../../routes';

function layout(name) {
	return function(resolve) {
		require(['../../../layouts/' + name + '.vue'], resolve);
	}
}

function getIndex(element) {
	return element.path == '/admin';
}

let vuetrust_routes = [
	{
		path: '/admin/vue-trust/role',
		components: {
			main: resolve => require(['../../../components/bantenprov/vue-trust/role/role.index.vue'], resolve),
			navbar: resolve => require(['../../../components/Navbar.vue'], resolve),
			sidebar: resolve => require(['../../../components/Sidebar.vue'], resolve)
		},
		meta: {
			title: "Role"
		}
    },
    {
		path: '/admin/vue-trust/role/create',
		components: {
			main: resolve => require(['../../../components/bantenprov/vue-trust/role/role.create.vue'], resolve),
			navbar: resolve => require(['../../../components/Navbar.vue'], resolve),
			sidebar: resolve => require(['../../../components/Sidebar.vue'], resolve)
		},
		meta: {
			title: "Role"
		}
    },
		{
			path: '/admin/vue-trust/role/:id/set-permission',
			components: {
				main: resolve => require(['../../../components/bantenprov/vue-trust/role/role.setpermission.vue'], resolve),
				navbar: resolve => require(['../../../components/Navbar.vue'], resolve),
				sidebar: resolve => require(['../../../components/Sidebar.vue'], resolve)
			},
			meta: {
				title: "Role"
			}
    },
		{
			path: '/admin/vue-trust/role/:id/show',
			components: {
				main: resolve => require(['../../../components/bantenprov/vue-trust/role/role.show.vue'], resolve),
				navbar: resolve => require(['../../../components/Navbar.vue'], resolve),
				sidebar: resolve => require(['../../../components/Sidebar.vue'], resolve)
			},
			meta: {
				title: "Role"
			}
    },
    {
		path: '/admin/vue-trust/role/:id/edit',
		components: {
			main: resolve => require(['../../../components/bantenprov/vue-trust/role/role.edit.vue'], resolve),
			navbar: resolve => require(['../../../components/Navbar.vue'], resolve),
			sidebar: resolve => require(['../../../components/Sidebar.vue'], resolve)
		},
		meta: {
			title: "Role"
		}
	},
    {
		path: '/admin/vue-trust/permission',
		components: {
			main: resolve => require(['../../../components/bantenprov/vue-trust/permission/permission.index.vue'], resolve),
			navbar: resolve => require(['../../../components/Navbar.vue'], resolve),
			sidebar: resolve => require(['../../../components/Sidebar.vue'], resolve)
		},
		meta: {
			title: "Permission"
		}
    },
    {
		path: '/admin/vue-trust/permission/create',
		components: {
			main: resolve => require(['../../../components/bantenprov/vue-trust/permission/permission.create.vue'], resolve),
			navbar: resolve => require(['../../../components/Navbar.vue'], resolve),
			sidebar: resolve => require(['../../../components/Sidebar.vue'], resolve)
		},
		meta: {
			title: "Permission"
		}
    },
    {
		path: '/admin/vue-trust/permission/:id/show',
		components: {
			main: resolve => require(['../../../components/bantenprov/vue-trust/permission/permission.show.vue'], resolve),
			navbar: resolve => require(['../../../components/Navbar.vue'], resolve),
			sidebar: resolve => require(['../../../components/Sidebar.vue'], resolve)
		},
		meta: {
			title: "Permission"
		}
    },
    {
		path: '/admin/vue-trust/permission/:id/edit',
		components: {
			main: resolve => require(['../../../components/bantenprov/vue-trust/permission/permission.edit.vue'], resolve),
			navbar: resolve => require(['../../../components/Navbar.vue'], resolve),
			sidebar: resolve => require(['../../../components/Sidebar.vue'], resolve)
		},
		meta: {
			title: "Permission"
		}
	}
];

vuetrust_routes.forEach((route,index)=>{
	routes[routes.findIndex(getIndex)].children.push(route);
});

export default vuetrust_routes;