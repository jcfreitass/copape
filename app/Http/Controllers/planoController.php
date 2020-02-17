<?php

namespace App\Http\Controllers;

use App\planos;
use App\User;
use App\course;
use App\course_user;
use Auth;
use DB;
use Hash;
use Storage;
use File;
use Illuminate\Support\Facades\Input;
use Filesystem;

use Illuminate\Http\Request;

class planoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $planos = DB::table('planos')
            ->where('PlanAuth', '=', 1)
            ->get();
        
        return view('index', compact('planos'));
        
    }


        
    // função para filtrar apenas o plano de determinado perfil
    public function perfilAluno()
    {   
       
        $user = DB::table('Users')
            ->where('id','=',Auth::user()->id )
            ->get();

        $refusedCourse = DB::table('course_users')
            ->where('user_id','=',Auth::user()->id )
            ->where('courseAuth','=',0)
            ->get();

        
        return view('perfilAluno', compact('user','refusedCourse'));
        
    }

    public function handlePlanStudent() {
        
        $planosPending = DB::table('planos')
            ->where('id_aluno','=',Auth::user()->id )
            ->where('validacao','=',0 )
            ->get();

        $planos = DB::table('planos')
            ->where('id_aluno','=',Auth::user()->id )
            ->where('validacao','=',1 )
            ->get();

        $planoRejected = DB::table('planos')
            ->where('id_aluno','=',Auth::user()->id )
            ->where('recusarPlano','=',1 )
            ->get();
        
        return view('handlePlanStudent', compact('planosPending','planos','planoRejected'));
    }

    // função para filtrar apenas os planos que os professores tem aceitos
    public function perfilProfessor()
    {   
       
        $user = DB::table('Users')
            ->where('id','=',Auth::user()->id )
            ->get();
        
        $refusedCourse = DB::table('course_users')
            ->where('user_id','=',Auth::user()->id )
            ->where('courseAuth','=',0)
            ->get();
    
        return view('perfilProfessor', compact('user','refusedCourse'));
        
    }

    public function handlePlanTeacher() {
        
        $idADM=Auth::user()->id;

        if($idADM === 1){

            $planosPending  = DB::table('planos')
                ->where('validacao','=',0 )
                ->where('recusarPlano','=',0 )
                ->get();
           

        }else{
            $planosPending = DB::table('course_users')
                ->join('planos', function ($join) {
                    $join->on('planos.curso', '=', 'course_users.course_id')
                        ->where('course_users.user_id', '=', Auth::user()->id)
                        ->where('course_users.checkCourse', '=', 1);
                })
                ->where('validacao','=',0 )
                ->where('recusarPlano','=',0 )
                ->get();
            }

        $planoAccept = DB::table('planos')
            ->where('PlanAuth','=',Auth::user()->id )
            ->get();
    
        return view('handlePlanTeacher', compact('planosPending','planoAccept'));
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       return view('createPlan'); 
    }

    public function autocomplete(Request $request)
    {
        $data = course::select("name")
                ->where("name","LIKE","%{$request->input('query')}%")
                ->get();
   
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $courseRequest = $request->get('curso');
        $loadCurse = DB::table('courses')->where('name', $courseRequest)->value('id');
        
        $idPlano = $request->file('planoEnsino')->store("download");
        if($request->materialExtra != null ){
            $idMaterialExtra = $request->file('materialExtra')->store('download'); 
        }

        $planos = new Planos();
        $planos->id_aluno = Auth::User()->id;
        $planos->autor = Auth::User()->name;
        $planos->title = $request->title;
        $planos->disciplina = $request->disciplina;
        $planos->curso = $loadCurse;
        $planos->planDescription = $request->planDescription;
        $planos->datas = $request->datas;
        $planos->planoEnsino = $idPlano;

        if(  $request->materialExtra != null ){
            $planos->materialExtra = $idMaterialExtra;
            $planos->nameMaterialExtra = $request->materialExtra->getClientOriginalName();
        }else {
            $planos->materialExtra = null;
        }
        $planos->nivelEnsino = $request->nivelEnsino;
        $planos->semestreAno = $request->semestreAno;
        $planos->knowArea = $request->knowArea;
        $planos->typePlan = $request->typePlan;
        $planos->validacao = 0;
        $planos->recusarPlano = 0;
        $planos->namePlan = $request->planoEnsino->getClientOriginalName();
        $planos->save();

        $id = $planos->id;
        return redirect()->route('selectPlan', $id);
    }

    public function download($idx_plano)
    {   
        $plano = Planos::find($idx_plano);
        $file = "C:\cope\storage\app\public\\".$plano->planoEnsino;
        $name = $plano->namePlan;

        $headers = array(
            'Content-Type: application/form-data',
        );
        return  response()->download($file, $name);
    }

    public function downloadMatrialExtra($idx_plano)
    {   
        $plano = Planos::find($idx_plano);
        $file = "C:\cope\storage\app\public\\".$plano->materialExtra;
        $name = $plano->nameMaterialExtra;

        $headers = array(
            'Content-Type: application/form-data',
        );
        return response()->download($file, $name);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $planos = planos::findOrFail($id);
        
        $arrayProfessor = DB::table('Users')
        ->where('checkProfessor','=',1 )
        ->get();
        
        return view('edit', compact('planos','arrayProfessor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        if (isset($_POST['update'])) {
            $planos = $request->all();
            $id = planos::findOrFail($id);
            $id->update($planos);
            return redirect()->route('selectPlan', $id);
        }
        elseif (isset($_POST['saveNew'])) {
            
            $courseRequest = $request->get('curso');
            $loadCurse = DB::table('courses')->where('name', $courseRequest)->value('id');
            if($request->planoEnsino != null ){
            $idPlano = $request->file('planoEnsino')->store("download");
            }
            if($request->materialExtra != null ){
                $idMaterialExtra = $request->file('materialExtra')->store('download'); 
            }
    
            $planos = new Planos();
            $planos->id_aluno = Auth::User()->id;
            $planos->autor = Auth::User()->name;
            $planos->title = $request->title;
            $planos->disciplina = $request->disciplina;
            $planos->curso = $loadCurse;
            $planos->planDescription = $request->planDescription;
            $planos->datas = $request->datas;
            $planos->planoEnsino = $idPlano;
    
            if(  $request->materialExtra != null ){
                $planos->materialExtra = $idMaterialExtra;
                $planos->nameMaterialExtra = $request->materialExtra->getClientOriginalName();
            }else {
                $planos->materialExtra = null;
            }
            $planos->nivelEnsino = $request->nivelEnsino;
            $planos->semestreAno = $request->semestreAno;
            $planos->knowArea = $request->knowArea;
            $planos->typePlan = $request->typePlan;
            $planos->validacao = 0;
            $planos->recusarPlano = 0;
            $planos->namePlan = $request->planoEnsino->getClientOriginalName();
            $planos->save();
    
            $id = $planos->id;
            return redirect()->route('selectPlan', $id);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $planoDelete = planos::findOrFail($id);
        $planoDelete->delete($id);

        return back()->with(['success' => ' cliente deletado com sucesso!']);
    }

    public function select($id)
    {

        $planosAlocados = DB::table('Planos') // selecionar os dados dos planos
        ->where('id','=',$id )
        ->get();
       
        return view('planoAula', compact('planosAlocados'));
    }

    public function get_user_checkAluno() {
        if(Auth::check()){
            return Auth::User()->checkAluno;
        }
       return 0;                            
    }
    public function get_user_checkProfessor() {
        if(Auth::check()){
            return Auth::User()->checkProfessor;
        }
       return 0;
    }
    public function get_user_id() {
        if(Auth::check()){
            return Auth::User()->id;
        }
       return 0;
    }

    public function planoRecusado() {
        $recusarPlano = DB::table('planos')
            ->where('recusarPlano', 1)
            ->where('id_aluno', Auth::User()->id)
            ->value('recusarPlano');

        if( $recusarPlano == 1  ){
            return 1;
        }else {
            return 0;   
        }
        
    }
    
    public function search(Request $request){
        $search = $request->get('search');
        if($search == ''){
           return redirect()->route('home');
        }else{

        $planos = DB::table('planos')
            ->where( 'autor','like',"%{$search}%")
            ->orWhere( 'disciplina','like',"%{$search}%")
            ->orWhere( 'title','like',"%{$search}%")
            ->orWhere( 'semestreAno','like',"%{$search}%")
            ->orWhere( 'nivelEnsino','like',"%{$search}%")
            ->orWhere( 'knowArea','like',"%{$search}%")
            ->orWhere( 'planDescription','like',"%{$search}%")
            ->paginate(5);
    
    
       
        return view('index',['planos' => $planos]);
        
        }
    }

    /**
     * Validation Plan
     *
     */

    public function validacao($id)
    {
        $validacao = DB::table('planos')
            ->where('id', $id)
            ->update(['validacao' => 1]);
        
        $validacao = DB::table('planos')
            ->where('id', $id)
            ->update(['recusarPlano' => 0]);

        $validacao = DB::table('planos')
            ->where('id', $id)
            ->update(['PlanAuth' => Auth::User()->id]);
        
        return redirect()->back();
       
    }

    public function recusarPlano($id)
    {
        $recusarPlano = DB::table('planos')
            ->where('id', $id)
            ->update(['validacao' => 0]);
      
        $recusarPlano2 = DB::table('planos')
            ->where('id', $id)
            ->update(['recusarPlano' => 1]);
        
        $recusarPlano3 = DB::table('planos')
            ->where('id', $id)
            ->update(['PlanAuth' => null]);

        return redirect()->back();
       
    }
    /*public function viewButtonValidation(){
        


        if( (Auth::User()->checkProfessor = 1 ) && ( Auth::User()->name =   ) ){
            return Auth::User()->checkAluno;
        }
       return 0;    

    } */
    

     /**
     * Choose Type User.
     *
     */

    public function chooseType()
    {
        //var_dump(Auth::User());
        if(Auth::user() != null) {
            return view('chooseType'); 
        }
        return view('auth.login');
    }
    
    public function chooseTypeTeacher()
    {
        
        $chooseTypeTeacher = DB::table('Users')
        ->where('id', Auth::user()->id)
        ->update(['checkProfessor' => 1]);
        
        return redirect()->route('chooseCourse');
        
    }

    public function chooseTypeStudent()
    {
        
        $chooseTypeStudent = DB::table('Users')
        ->where('id', Auth::user()->id)
        ->update(['checkAluno' => 1]);

        return redirect()->route('chooseCourse');
        
    }
    

    
    public function chooseTypeUpdate()
    {
        //var_dump(Auth::User());
        if(Auth::user() != null) {
            return view('chooseTypeUpdate'); 
        }
        return view('auth.login');
    }

    public function chooseTypeTeacherUpdate()
    {
        $chooseTypeStudentDrop = DB::table('Users')
        ->where('id', Auth::user()->id)
        ->update(['checkAluno' => 0]);

        $chooseTypeTeacherDrop = DB::table('Users')
        ->where('id', Auth::user()->id)
        ->update(['checkProfessor' => 0]);

        $chooseTypeTeacher = DB::table('Users')
        ->where('id', Auth::user()->id)
        ->update(['checkProfessor' => 1]);

        // destroy course //
        $authCourse = DB::table('course_users')
            ->where('user_id','=', Auth::User()->id)
            ->pluck('id');

        $counter = count($authCourse);
        
        while ( $counter > 0) {
            $id = DB::table('course_users')
                ->where('user_id','=', Auth::User()->id)
                ->value('id');

            $courseDestroy = course_user::findOrFail($id);
            $courseDestroy->delete($id);

            $counter--;
        }
        
        return redirect()->route('chooseCourse');
        
    }

    public function chooseTypeStudentUpdate()
    {
        $chooseTypeStudentDrop = DB::table('Users')
        ->where('id', Auth::user()->id)
        ->update(['checkAluno' => 0]);

        $chooseTypeTeacherDrop = DB::table('Users')
        ->where('id', Auth::user()->id)
        ->update(['checkProfessor' => 0]);
        
        $chooseTypeStudent = DB::table('Users')
        ->where('id', Auth::user()->id)
        ->update(['checkAluno' => 1]);

        // destroy course //
        $authCourse = DB::table('course_users')
            ->where('user_id','=', Auth::User()->id)
            ->pluck('id');

        $counter = count($authCourse);
        
        while ( $counter > 0) {
            $id = DB::table('course_users')
                ->where('user_id','=', Auth::User()->id)
                ->value('id');

            $courseDestroy = course_user::findOrFail($id);
            $courseDestroy->delete($id);

            $counter--;
        }

        return redirect()->route('chooseCourse');
        
    }
    /**
     * Edit User.
     *
     */

    public function editUser(User $User)
    {
        $User = Auth::User();
        
        return view('editUser', compact('User'));
    }

    public function updateUser( Request $request){
        
        $User = Auth::User();
        $User->update($request->all());
        $User->save();
        
       
        $authCourse = DB::table('course_users')
            ->where('user_id','=', Auth::User()->id)
            ->pluck('id');
        

        $counter = count($authCourse);
        
        while ( $counter > 0) {
            $id = DB::table('course_users')
                ->where('user_id','=', Auth::User()->id)
                ->value('id');

            $courseDestroy = course_user::findOrFail($id);
            $courseDestroy->delete($id);

            $counter--;
        }

        return redirect()->route('chooseCourse');
    }

    /**
     * Update Password.
     *
     */

    public function showChangePasswordForm(){
        return view('changepassword');
    }

    public function changePassword(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Password changed successfully !");
    }

 /**
     * Set Course.
     *
     */

    public function chooseCourse()
    {
        //var_dump(Auth::User());
        if(Auth::user() != null) {
            $course = DB::table('course_users')
                ->where('user_id','=',Auth::user()->id )
                ->get();
            return view('chooseCourse',compact('course')); 
        }
        return view('auth.login');
    }
    public function createCourse(Request $request)
    {
        $courseRequest = $request->get('curso');
        $loadCurse = DB::table('courses')->where('name', $courseRequest)->value('id');
    
        $courseID = new Course_user();
                $courseID->user_id = Auth::User()->id;
                $courseID->course_id = $loadCurse;
                $courseID->checkCourse = 0;
                $courseID->save();

        return redirect()->back();
        //return redirect()->route('home');
    }

    public function destroyCourse($id)
    {
        $planoDelete = course_user::findOrFail($id);
        $planoDelete->delete($id);

        return redirect()->back();
    }

    public function authUser()
    {

        $authTeacher = DB::table('Users')
            ->leftJoin('course_users', 'users.id', '=', 'course_users.user_id')
            ->where('users.checkProfessor','=',1 )
            ->where('users.id','>',1 )     
            ->where('course_users.courseAuth','=',null)
            ->get();

        $authenticatedTeacher =DB::table('users')
            ->leftJoin('course_users', 'users.id', '=', 'course_users.user_id')
            ->where('users.checkProfessor','=',1)
            ->where('course_users.courseAuth','=',Auth::User()->id)             //adm
            ->get();

        $authStudentADM = DB::table('Users')
            ->leftJoin('course_users', 'users.id', '=', 'course_users.user_id')
            ->where('course_users.checkCourse','=',0)
            ->where('course_users.courseAuth','=',null)
            ->where('users.checkAluno','=',1)
            ->get();
   
        function getArray() {
            $authCourse = DB::table('course_users')
            ->where('user_id','=',Auth::User()->id )
            ->where('checkCourse','=',1)
            ->pluck('course_id');
        
            return array($authCourse);
        }

     
        $authStudent =DB::table('users')
            ->leftJoin('course_users', 'users.id', '=', 'course_users.user_id')
            ->where('course_users.checkCourse','=',0)
            ->where('course_users.courseAuth','=',null)
            ->where('users.checkAluno','=',1)
            ->whereIn('course_users.course_id', getArray()[0])
            ->get();


        $authCourse =DB::table('users')
            ->leftJoin('course_users', 'users.id', '=', 'course_users.user_id')
            ->where('course_users.checkCourse','=',1)
            ->where('course_users.courseAuth','=',Auth::User()->id)
            ->get();
        
        return view('authUser' ,compact('authTeacher','authStudent','authCourse','authStudentADM','authenticatedTeacher')); 
    }

    public function acceptCourse($id){

        $validacao = DB::table('course_users')
            ->where('id', $id)
            ->update(['checkCourse' => 1]);
        $validacao = DB::table('course_users')
            ->where('id', $id)
            ->update(['courseAuth' => Auth::User()->id]);
            
        return redirect()->back();

    }

    public function refuseCourse($id){

        $refuse = DB::table('course_users')
            ->where('id', $id)
            ->update(['courseAuth' => 0]);

        $refuse = DB::table('course_users')
            ->where('id', $id)
            ->update(['checkCourse' => 0]);


        return redirect()->back();

    }
    public function againCourse($id){

        $refuse = DB::table('course_users')
            ->where('id', $id)
            ->update(['courseAuth' => null]);

        return redirect()->back();
    }
    public function refusedCourse() {
        $checkCourse = DB::table('course_users')
            ->where('courseAuth', 0)
            ->where('user_id','=', Auth::User()->id)
            ->value('courseAuth');

       
        if( $checkCourse === 0  ){
            return 1;
        }else {
            return 0;   
        }
        
    }
    
    public function management_user()
    {  

        $userSearch = DB::table('users')
            ->where('id','>', 1)
            ->get();
    

        return view('managementUser', compact('userSearch'));
    }
    public function destroyUser($id)
    {
        
        $authCourse = DB::table('course_users')
            ->where('user_id','=', $id)
            ->pluck('id');

        $counter = count($authCourse);
        
        while ( $counter > 0) {
            $userTeacher = DB::table('course_users')
            ->where('user_id','=', $id)
            ->value('id');


            $userDelete = course_user::findOrFail($userTeacher);
            $userDelete->delete($userTeacher);

            $counter--;
        }

        $userDelete = user::findOrFail($id);
        $userDelete->delete($id);

        return back()->with(['success' => ' cliente deletado com sucesso!']);
    }

    public function searchUser(Request $request){

        $search = $request->get('search');
        
        if($search == ''){
            return redirect()->route('managementUser');
        }else{
            if(($search == 'professor') || ($search == 'Professor') )  {

                $planos = DB::table('users')
                    ->where ( 'id','>',1)
                    ->where ( 'checkProfessor','=',1)
                    ->get();
                return view('managementUser',['userSearch' => $planos]);

            }elseif(($search == 'aluno') || ($search == 'Aluno')){

                $planos = DB::table('users')
                    ->where ( 'id','>',1)
                    ->where ( 'checkAluno','=',1)
                    ->get();
                return view('managementUser',['userSearch' => $planos]);

            }else{

                $planos = DB::table('users')
                    ->where ( 'name','like',"%{$search}%")
                    ->orWhere( 'registration','like',"%{$search}%")
                    ->orWhere( 'email','like',"%{$search}%")
                    ->orWhere( 'telefone','like',"%{$search}%")
                    ->paginate(5);
                
                return view('managementUser',['userSearch' => $planos]);

            }
        }
    }
    

}
