<template>
  <div class="card">
    <div class="card-header">
      <i class="fa fa-table" aria-hidden="true"></i> Edit permission [ {{model.name}} ]

      <ul class="nav nav-pills card-header-pills pull-right">
        <li class="nav-item">
          <button class="btn btn-primary btn-sm" role="button" @click="back">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </button>
        </li>
      </ul>
    </div>

    <div class="card-body">
      <vue-form class="form-horizontal form-validation" :state="state" @submit.prevent="onSubmit">
            <div class="form-row">
                <div class="col-md">
                    <validate tag="div">
                    <input class="form-control" v-model="model.name" required autofocus name="name" type="text" placeholder="Name">

                    <field-messages name="name" show="$invalid && $submitted" class="text-danger">
                        <small class="form-text text-success">Looks good!</small>
                        <small class="form-text text-danger" slot="required">Name is a required field</small>
                    </field-messages>
                    </validate>
                </div>
            </div>

            <div class="form-row mt-4">
                <div class="col-md">
                    <validate tag="div">
                        <input class="form-control" v-model="model.display_name" required autofocus name="display_name" type="text" placeholder="Display name">

                        <field-messages name="display_name" show="$invalid && $submitted" class="text-danger">
                            <small class="form-text text-success">Looks good!</small>
                            <small class="form-text text-danger" slot="required">Display name is a required field</small>
                        </field-messages>
                    </validate>
                </div>
            </div>          

            <div class="form-row mt-4">
                <div class="col-md">
                    <validate tag="div">
                    <label for="description">Description</label>
                    <textarea class="form-control" v-model="model.description" required autofocus name="description" id="description" rows="3" placeholder="Description"></textarea>

                    <field-messages name="description" show="$invalid && $submitted" class="text-danger">
                        <small class="form-text text-success">Looks good!</small>
                        <small class="form-text text-danger" slot="required">Description is a required field</small>
                    </field-messages>
                    </validate>
                </div>
            </div>
            <div class="form-row mt-4">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Submit</button>

                    <button type="button" class="btn btn-secondary" @click="reset">Reset</button>
                </div>
            </div>
      </vue-form>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    axios.get('vue-trust/permission/' + this.$route.params.id + '/edit')
      .then(response => {
        if (response.data.status == true) {
          this.model.name = response.data.permission.name;
          this.model.display_name = response.data.permission.display_name;
          this.model.description = response.data.permission.description;
        } else {
          this.toast_message('error','error','error #404');
        }
      })
      .catch(function(response) {
        this.toast_message('error','error','error #500');
        window.location.href = '#/admin/vue-trust/permission';
      });
  },
  data() {
    return {
      state: {},
      model: {
        name: "",
        display_name: "",
        description: ""
      }
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
    onSubmit: function() {
      let app = this;

      if (this.state.$invalid) {
        return;
      } else {
        axios.put('vue-trust/permission/' + this.$route.params.id + '/update', {
            name: this.model.name,
            display_name: this.model.display_name,
            description: this.model.description
          })
          .then(response => {
            if (response.data.status == true) {
                this.toast_message('success','success',response.data.message);
                app.back();
            } else {
              this.toast_message('error','error','error #404');
            }
          })
          .catch(function(response) {
            this.toast_message('error','error','error #500');
          });
      }
    },
    reset() {
      axios.get('vue-trust/permission/' + this.$route.params.id + '/edit')
        .then(response => {
          if (response.data.status == true) {
            this.model.name = response.data.permission.name;
            this.model.display_name = response.data.permission.display_name;
            this.model.description = response.data.permission.description;
          } else {
            this.toast_message('error','error','error #404');
          }
        })
        .catch(function(response) {
          this.toast_message('error','error','error #500');
        });
    },
    back() {
      window.location = '#/admin/vue-trust/permission';
    }
  }
}
</script>
