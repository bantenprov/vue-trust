<?php namespace Bantenprov\VueTrust\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bantenprov\VueTrust\Facades\VueTrust;
use Bantenprov\VueTrust\Models\VueTrustModel;
use App\Role;
use App\Permission;

use Validator;

/**
 * The VueTrustController class.
 *
 * @package Bantenprov\VueTrust
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class VueTrustController extends Controller
{

    protected $role;
    protected $permission;
    
    

    //[Function] __construct
    public function __construct(Role $role, Permission $permission){
        
        $this->role         = $role;
        $this->permission   = $permission;

    }    

    public function demo()
    {
        return VueTrust::welcome();
    }

    //[Function] roleIndex
    public function roleIndex(Request $request){        

        $response = array();

        if (request()->has('sort')) {
            list($sortCol, $sortDir) = explode('|', request()->sort);

            $query = $this->role->orderBy($sortCol, $sortDir);
        } else {
            $query = $this->role->orderBy('id', 'asc');
        }

        if ($request->exists('filter')) {
            $query->where(function($q) use($request) {
                $value = "%{$request->filter}%";
                $q->where('name', 'like', $value)
                    ->orWhere('description', 'like', $value);
            });
        }

        $perPage = request()->has('per_page') ? (int) request()->per_page : null;
        $response = $query->paginate($perPage);                

        return response()->json($response);
    }

    //[Function] roleStore
    public function roleStore(Request $request){
        
        $response = array();
        $save = array();

        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'display_name'  => 'required',
            'description'   => 'required'
        ]);

        if($validator->fails()){
            $response['message']    = "failed add role";
            $response['status']     = false;
        }else{
            $response['message']    = "success add new role";
            $response['status']     = true;

            $save['name']           = $this->macineName($request->name);
            $save['display_name']   = title_case($request->display_name);
            $save['description']    = $request->description;

            $this->role->create($save);
        }
        
        return response()->json($response);
    }

    //[Function] roleShow
    public function roleShow($id, Request $request){
        $response = array();

        $role = $this->role->findOrFail($id);

        $response['status'] = true;
        $response['role']   = $role;
        
        return response()->json($response);
    }

    //[Function] roleEdit
    public function roleEdit($id, Request $request){
        $response = array();

        $role = $this->role->findOrFail($id);

        $response['status'] = true;
        $response['role']   = $role;
        
        return response()->json($response);
    }

    //[Function] roleUpdate
    public function roleUpdate($id, Request $request){
        $response = array();
        $save = array();
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'display_name'  => 'required',
            'description'   => 'required'
        ]);

        if($validator->fails()){
            $response['message']    = "failed update role";
            $response['status']     = false;
        }else{

            $save['name']           = $this->macineName($request->name);
            $save['display_name']   = title_case($request->display_name);
            $save['description']    = $request->description; 

            $this->role->findOrFail($id)->update($save);

            $response['message']    = "success update role";
            $response['status']     = true;                       

        }
        
        return response()->json($response);
    }   
    
    //[Function] roleDestroy
    public function roleDestroy($id, Request $request){
        $response = array();

        $role = $this->role->findOrFail($id);

        $response['message']    = "success delete role [" . $role->name . "]";
        $response['status']     = true;

        $role->delete();
        
        return response()->json($response);
    }

    //[Function] permissionIndex
    public function permissionIndex(Request $request){
        $response = array();

        if (request()->has('sort')) {
            list($sortCol, $sortDir) = explode('|', request()->sort);

            $query = $this->permission->orderBy($sortCol, $sortDir);
        } else {
            $query = $this->permission->orderBy('id', 'asc');
        }

        if ($request->exists('filter')) {
            $query->where(function($q) use($request) {
                $value = "%{$request->filter}%";
                $q->where('name', 'like', $value)
                    ->orWhere('description', 'like', $value);
            });
        }

        $perPage = request()->has('per_page') ? (int) request()->per_page : null;
        $response = $query->paginate($perPage);                

        return response()->json($response);
    }

    //[Function] permissionStore
    public function permissionStore(Request $request){
        $response = array();
        $save = array();

        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'display_name'  => 'required',
            'description'   => 'required'
        ]);

        if($validator->fails()){
            $response['message']    = "failed add permission";
            $response['status']     = false;
        }else{
            $response['message']    = "success add new permission";
            $response['status']     = true;

            $save['name']           = $this->macineName($request->name);
            $save['display_name']   = title_case($request->display_name);
            $save['description']    = $request->description;

            $this->permission->create($save);
        }
        
        return response()->json($response);
    }

    //[Function] permissionShow
    public function permissionShow($id, Request $request){
        $response = array();

        $role = $this->permission->findOrFail($id);

        $response['status']       = true;
        $response['permission']   = $role;
        
        return response()->json($response);
    }

    //[Function] permissionEdit
    public function permissionEdit($id, Request $request){
        $response = array();

        $role = $this->permission->findOrFail($id);

        $response['status'] = true;
        $response['permission']   = $role;
        
        return response()->json($response);
    }

    //[Function] setPermission
    public function setPermission($id, Request $request){
        $response = array();

        $role = $this->role->findOrFail($id);
        $current_permissions = $role->permissions()->get();
        $permissions = $this->permission->all();
        
        foreach ($permissions as $permission) {

            array_set($permission, 'disable', false);

            foreach($current_permissions as $current_permision){
                if($permission->id == $current_permision->id){
                    
                    if($permission->id == $current_permision->id){
                        array_set($permission, 'disable', true);
                    }
                }else{
                    if($permission->id == $current_permision->id){
                        array_set($permission, 'disable', false);
                    }
                }
            }
        }
        

        $response['status']                 = true;
        $response['current_permissions']    = $current_permissions;
        $response['permissions']            = $permissions; 
        
        return response()->json($response);
    }

    //[Function] setPermissionStore
    public function setPermissionStore($id, Request $request){
        $response = array();

        $validator = Validator::make($request->all(), [
            'permission_id'          => 'required',
        ]);

        if($validator->fails()){
            $response['message']    = "failed add permission";
            $response['status']     = false;
        }else{
            $response['message']    = "success add new permission";
            $response['status']     = true;   

            $current_permissions = $this->role->findOrFail($id)->permissions()->get();   
            $save = $this->removeSamePermission($request->permission_id, $current_permissions);
            $this->role->findOrFail($id)->attachPermissions($save);
        }
        
        return response()->json($response);
    }

    //[Function] removePermissionFromRole
    public function removePermissionFromRole($id, Request $request){
        $response = array();

        $validator = Validator::make($request->all(), [
            'permission_id'          => 'required',
        ]);

        if($validator->fails()){
            $response['message']    = "failed remove permission";
            $response['status']     = false;
        }else{
            $response['message']    = "success remove new permission";
            $response['status']     = true;   
             
            $data = $request->permission_id;
            
            $this->role->findOrFail($id)->detachPermission($data);
        }
        
        return response()->json($response);
    }

    //[Function] removeSamePermission
    protected function removeSamePermission($array, $search){                
        
        foreach($search as $value1){   
            print_r("[".$value1->id."]");   
                
            $key = array_search($value1->id, $array);
            if(!empty($key)){
                unset($array[$key]);
            }                        
        }
        return $array;        
    }
    
    

    //[Function] macineName
    protected function macineName($text){
        
        $final = strtolower(str_replace(' ', '_', $text));

        return $final;

    }
    
    
}
