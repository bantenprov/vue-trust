<template>
  <div class="card">
    <div class="card-header">
      <i class="fa fa-table" aria-hidden="true"></i> Role

      <ul class="nav nav-pills card-header-pills pull-right">
        <li class="nav-item">
          <button class="btn btn-primary btn-sm" role="button" @click="createRow">
          	<i class="fa fa-plus" aria-hidden="true"></i>
          </button>
        </li>
      </ul>
    </div>

    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <vuetable-filter-bar></vuetable-filter-bar>
      </div>

      <div style="margin:20px 0;">
        <div v-if="loading" class="d-flex justify-content-start align-items-center">
          <i class="fa fa-refresh fa-spin fa-fw"></i>
          <span>Loading...</span>
        </div>
      </div>

      <div class="table-responsive">
        <vuetable ref="vuetable"
          api-url="/vue-trust/role"
          :fields="fields"
          :sort-order="sortOrder"
          :css="css.table"
          pagination-path=""
          :per-page="5"
          :append-params="moreParams"
          @vuetable:pagination-data="onPaginationData"
          @vuetable:loading="onLoading"
          @vuetable:loaded="onLoaded">
          <template slot="actions" slot-scope="props">
            <div class="btn-group pull-right" role="group" style="display:flex;">
              <button class="btn btn-success btn-sm" title="Set permission" role="button" @click="setPermission(props.rowData)">
                <span class="fa fa-key"></span>
              </button>
              <button class="btn btn-info btn-sm" role="button" @click="viewRow(props.rowData)">
                <span class="fa fa-eye"></span>
              </button>
              <button class="btn btn-warning btn-sm" role="button" @click="editRow(props.rowData)">
                <span class="fa fa-pencil"></span>
              </button>
              <button class="btn btn-danger btn-sm" role="button" @click="deleteRow(props.rowData)">
                <span class="fa fa-trash"></span>
              </button>
            </div>
          </template>
        </vuetable>
      </div>

      <div class="d-flex justify-content-between align-items-center">
        <vuetable-pagination-info ref="paginationInfo"
        ></vuetable-pagination-info>
        <vuetable-pagination ref="pagination"
          :css="css.pagination"
          @vuetable-pagination:change-page="onChangePage">
        </vuetable-pagination>
      </div>
    </div>
  </div>
</template>

<style>
.vuetable-th-sequence{
  width: 1px;
}
.vuetable-th-slot-actions {
  width: 1px;
  white-space: normal;
}
</style>

<script>
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo';
export default {
  components: {
    VuetablePaginationInfo
  },
  data() {
    return {
      loading: true,
      fields: [
        {
          name: '__sequence',
          title: '#',
          titleClass: 'center aligned',
          dataClass: 'right aligned'
        },
        {
          name: 'name',
          title: 'Name',
          sortField: 'name',
          titleClass: 'center aligned'
        },
        {
          name: 'display_name',
          title: 'Display Name',
          sortField: 'display_name',
          titleClass: 'center aligned'
        },
        {
          name: '__slot:actions',
          title: 'Actions',
          titleClass: 'center aligned',
          dataClass: 'center aligned'
        },
      ],
      sortOrder: [{
        field: 'name',
        direction: 'asc'
      }],
      moreParams: {},
      css: {
        table: {
          tableClass: 'table table-hover',
          ascendingIcon: 'fa fa-chevron-up',
          descendingIcon: 'fa fa-chevron-down'
        },
        pagination: {
          wrapperClass: 'vuetable-pagination btn-group',
          activeClass: 'active',
          disabledClass: 'disabled',
          pageClass: 'btn btn-light',
          linkClass: 'btn btn-light',
          icons: {
            first: 'fa fa-angle-double-left',
            prev: 'fa fa-angle-left',
            next: 'fa fa-angle-right',
            last: 'fa fa-angle-double-right'
          }
        }
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
    createRow() {      
      window.location = '#/admin/vue-trust/role/create';
    },
    setPermission(rowData) {
      window.location = '#/admin/vue-trust/role/' + rowData.id + '/set-permission';
    },
    viewRow(rowData) {
      window.location = '#/admin/vue-trust/role/' + rowData.id + '/show';
    },
    editRow(rowData) {
      window.location = '#/admin/vue-trust/role/' + rowData.id + '/edit';
    },
    deleteRow(rowData) {
      
      let app = this;
      if (confirm('Do you really want to delete it?')) {
        axios.delete('/vue-trust/role/'+ rowData.id +'/destroy')
          .then(function(response) {
            if (response.data.status == true) {
              app.$refs.vuetable.reload() 
              app.toast_message('success', 'success', response.data.message);             
            } else {              
              app.toast_message('error', 'error', 'error #500');
            }
          })
          .catch(function(response) {            
            app.toast_message('error', 'error', 'error #500');
          });
      }
    },
    onPaginationData(paginationData) {
      this.$refs.pagination.setPaginationData(paginationData);
      this.$refs.paginationInfo.setPaginationData(paginationData);
    },
    onChangePage(page) {
      this.$refs.vuetable.changePage(page);
    },
    onLoading: function() {
      this.loading = true;
    },
    onLoaded: function() {
      this.loading = false;
    }
  },
  events: {
    'filter-set' (filterText) {
      this.moreParams = {
        filter: filterText
      }
      Vue.nextTick(() => this.$refs.vuetable.refresh())
    },
    'filter-reset'() {
      this.moreParams = {
        //
      }
      Vue.nextTick(() => this.$refs.vuetable.refresh())
    }
  }
}
</script>