<template>
  <div>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fa fa-table" aria-hidden="true"></i> Role [ {{ model.display_name }} ]

        <ul class="nav nav-pills card-header-pills pull-right">
          <li class="nav-item">
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
                        <button class="btn btn-default btn-sm btn-block text-left" :title="current_permission.description" role="button">
                            {{ current_permission.display_name }}
                        </button>
                        <button class="btn btn-danger btn-sm" :title="'Remove '+ current_permission.display_name + ' Permission'" role="button" @click="onDelete(current_permission.id)">
                            <span class="fa fa-times"></span>
                        </button>
                    </div>
                    </div>  
                </div> 
                
          </div>
          <!-- <ul v-for="current_permission in model.current_permissions" :key="current_permission.id">
                <li>
                    <dl class="row">
                        <dt class="col-2">{{ current_permission.display_name }}</dt>
                        <dd class="col-10"><button class="btn btn-danger btn-sm"><span class="fa fa-times"></span></button></dd>
                    </dl>                                        
                </li>
                
          </ul> -->
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <i class="fa fa-key" aria-hidden="true"></i> Permissions
      </div>

      <div class="card-body">
        <vue-form class="form-horizontal form-validation" :state="state" @submit.prevent="onSubmit">
            <div class="form-check" v-for="permission in permissions" :key="permission.id">
                <input class="form-check-input" name="permissions" type="checkbox" v-model="model.permissions" :value="permission.id" :disabled="permission.disable">
                <label class="form-check-label">
                {{ permission.display_name }}
                </label>
            </div>
            
            <div class="form-row mt-4">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Submit</button>

                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </div>
        </vue-form>
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
    onSubmit() {
        let app = this;        
        axios.post('vue-trust/role/' + this.$route.params.id + '/set-permission-store',{ 
            permission_id: this.model.permissions
        })
        .then((response) =>{
            this.toast_message('success', 'success', response.data.message);
            app.reRender();
        })
        .catch((response) => {
            this.toast_message('error', 'error', 'error #500');  
        })
        
    }, 
    onDelete(id) {
        let app = this;
        if (confirm('Do you really want to delete it?')){            
            axios.post('/vue-trust/role/'+ this.$route.params.id +'/remove-permission-from-role', {
                permission_id:id
            })
            .then(function(response) {
                if (response.data.status == true) {                
                    app.toast_message('success', 'success', response.data.message); 
                    app.reRender();            
                } else {              
                    app.toast_message('error', 'error', 'error #500');
                }
            })
            .catch(function(response) {            
                app.toast_message('error', 'error', 'error #500');
            });
        }
        
    },
    reRender() {
        this.model.current_permissions = [];
        this.permissions = [];
        axios.get('vue-trust/role/' + this.$route.params.id + '/set-permission')
        .then(response => {
            if (response.data.status == true) {            
                response.data.current_permissions.forEach(current_permission => {
                    this.model.current_permissions.push(current_permission);            
                });

                response.data.permissions.forEach(permission => {
                    this.permissions.push(permission);            
                });
            } else {
                this.toast_message('error', 'error', 'error #404');
            }
        })
        .catch(function(response) {
            this.toast_message('error', 'error', 'error #500');
        })
    },
    back() {
      window.location = '#/admin/vue-trust/role';
    }
  }
}
</script>
