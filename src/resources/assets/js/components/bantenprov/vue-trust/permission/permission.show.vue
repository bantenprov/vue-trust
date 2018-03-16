<template>
  <div class="card">
    <div class="card-header">
      <i class="fa fa-table" aria-hidden="true"></i> Permission [ {{ model.name }} ]

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
        </dl>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    axios.get('vue-trust/permission/' + this.$route.params.id + '/show')
      .then(response => {
        if (response.data.status == true) {
          this.model.name = response.data.permission.name;
          this.model.display_name = response.data.permission.display_name;
          this.model.description = response.data.permission.description;
        } else {
          alert('Failed');
        }
      })
      .catch(function(response) {
        alert('Break');
        window.location.href = '#/admin/vue-trust/permission';
      })
  },
  data() {
    return {
      state: {},
      model: {
        name: "",
        display_name: "",
        description: "",
      }
    }
  },
  methods: {       
    back() {
      window.location = '#/admin/vue-trust/permission';
    }
  }
}
</script>
