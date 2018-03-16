<template>
  <div>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fa fa-table" aria-hidden="true"></i> Role [ {{ model.display_name }} ]

        <ul class="nav nav-pills card-header-pills pull-right">
          <li class="nav-item">
            <button class="btn btn-success btn-sm" role="button" @click="setPermission">
              <i class="fa fa-key" aria-hidden="true"></i> Set permission
            </button>
            <button class="btn btn-primary btn-sm" role="button" @click="back">
              <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </button>
          </li>
        </ul>
      </div>

      <div class="card-body">
          <dl class="row">
              <dt class="col-2">Name</dt>
              <dd class="col-10">{{ model.name }}</dd>
              
              <dt class="col-2">Display name</dt>
              <dd class="col-10">{{ model.display_name }}</dd>      

              <dt class="col-2">Description</dt>
              <dd class="col-10">{{ model.description }}</dd>

              <dt class="col-2">Permission</dt>
          </dl>
          <div v-for="current_permission in model.current_permissions" :key="current_permission.id">
                <div class="row mb-2 ml-2"> 
                    <div class="col-md-3">                                                                 
                    <div class="btn-group" role="group" style="display:flex;">
                        <button class="btn btn-success btn-sm" role="button">
                            <span class="fa fa-check"></span>
                        </button>
                        <button class="btn btn-default btn-sm btn-block text-left" :title="current_permission.description" role="button">
                            {{ current_permission.display_name }}
                        </button>                        
                    </div>
                    </div>  
                </div>                 
          </div>
      </div>
    </div>    
  </div>
</template>

<script>
export default {
  mounted() {
    axios.get('vue-trust/role/' + this.$route.params.id + '/show')
      .then(response => {
        if (response.data.status == true) {
          this.model.name = response.data.role.name;
          this.model.display_name = response.data.role.display_name;
          this.model.description = response.data.role.description;
        } else {
          alert('Failed');
        }
      })
      .catch(function(response) {
        alert('Break');
        window.location.href = '#/admin/vue-trust/role';
      }),

      axios.get('vue-trust/role/' + this.$route.params.id + '/set-permission')
      .then(response => {
        if (response.data.status == true) {
          response.data.permissions.forEach(permission => {
            this.permissions.push(permission);            
          });

          response.data.current_permissions.forEach(current_permission => {
            this.model.current_permissions.push(current_permission);            
          });
        } else {
          alert('Failed');
        }
      })
      .catch(function(response) {
        alert('Break');
        window.location.href = '#/admin/vue-trust/role';
      })
  },
  data() {
    return {
      state: {},
      model: {
        name: "",
        display_name: "",
        description: "",
        permissions:[],
        current_permissions:[]
      },
      permissions:[]
    }
  },
  methods: { 
    toast_message(typem,title,message,event) {
        switch (typem) {
            case 'success':
            miniToastr.success(message, title);
            break;
            case 'error':
            miniToastr.error(message, title);          
            break;
            case 'info':
            miniToastr.info(message, title);     
            break;
        }      
    },   
    setPermission() {
      window.location = '#/admin/vue-trust/role/' + this.$route.params.id + '/set-permission';
    },     
    back() {
      window.location = '#/admin/vue-trust/role';
    }
  }
}
</script>
