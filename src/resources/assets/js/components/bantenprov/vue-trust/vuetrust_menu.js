import MenuItems from '../../../menu';

function getIndex(element) {
  return element.name == 'Admin';
}

let vuetrust_menu = 
{
  name: 'Vue trust',        
  icon: 'fa fa-angle-double-right',
  child: [
    {
      name: 'Role',
      link: '/admin/vue-trust/role',
      icon: 'fa fa-angle-right'
    },
    {
      name: 'Permission',
      link: '/admin/vue-trust/permission',
      icon: 'fa fa-angle-right'
    }
  ]
};

MenuItems[MenuItems.findIndex(getIndex)].childItem.push(vuetrust_menu);

export default vuetrust_menu;