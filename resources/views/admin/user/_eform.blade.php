
<div class="form-group">
  <label for="province">Role:</label>
  <select id="role_id" name="role_id" class="form-control">
                    <option selected="">Choose...</option>
                     @foreach($roles as $role)
                <option value="{{ $role->id }}" @if($role->id == $user->role_id) selected @endif>{{ $role->name }}</option>
            @endforeach
    </select>
    </div>                                               
<div class="row">
            <div class="col-lg-20">
             <div class="card">
             <div class="card-header">
               <h4 class="card-title">User Validation</h4>
             </div>
             <div class="card-body">
                                <div class="basic-form">
                                    <form class="form-valide-with-icon needs-validation" novalidate="">
                                        <div class="mb-3">
                                            <label class="text-label form-label" for="validationCustomUsername">Firstname <span class="text-danger">*</span></label>
                                            <div class="input-group">
												<span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                                <input type="text" class="form-control" id="validationCustomUsername" name="firstname" placeholder="Enter the Firstname.." required="" value="{{ (isset($user->admin)) ? $user->admin->firstname: ((isset($user->receptionist)) ? $user->receptionist->firstname : '') }}">
												<div class="invalid-feedback">
													Please Enter the Firstname.
												  </div>
                                            </div>
                                        </div>
                                        </div>
                            
                                <div class="basic-form">
                                    <form class="form-valide-with-icon needs-validation" novalidate="">
                                        <div class="mb-3">
                                            <label class="text-label form-label" for="validationCustomUsername">Lastname <span class="text-danger">*</span></label>
                                            <div class="input-group">
												<span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                                <input type="text" class="form-control" id="validationCustomUsername" name="lastname" placeholder="Enter the Lastname.." required=""  value="{{ (isset($user->admin)) ? $user->admin->lastname: ((isset($user->receptionist)) ? $user->receptionist->lastname : '') }}">
												<div class="invalid-feedback">
													Please Enter the Lastname.
												  </div>
                                            </div>
                                        </div>
                                                
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="validationCustom02">Email <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="validationCustom02" name="email" placeholder="Your valid email.." required="" value="{{ (isset($user->admin)) ? $user->email: ((isset($user->receptionist)) ? $user->email : '') }}">
														<div class="invalid-feedback">
															Please enter a Email.
														</div>
                                                    </div>
                                                </div>

                                               <div class="mb-3">
                                            <label class="text-label form-label" for="dlab-password">Password *</label>
                                            <div class="input-group transparent-append">
												<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                                <input type="password" class="form-control" id="dlab-password" name="password" placeholder="Choose a safe one.." required="" value="{{ (isset($user->admin)) ? $user->password: ((isset($user->receptionist)) ? $user->password : '') }}">
												<span class="input-group-text show-pass"> 
													<i class="fa fa-eye-slash"></i>
													<i class="fa fa-eye"></i>
												</span>
                                                <div class="invalid-feedback">
													Please Enter a password.
												</div>
                                            </div>
                                        </div>
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="validationCustom04">Address<span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
														<input type="text" class="form-control" id="validationCustom02" name="address" placeholder="Enter the Address" required="" value="{{ (isset($user->admin)) ? $user->admin->address: ((isset($user->receptionist)) ? $user->receptionist->address : '') }}">
                                                        <div class="invalid-feedback">
															Please enter the Address.
														</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="validationCustom08">National ID card number
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="validationCustom08" name="id_number"  placeholder="000000000X/V" required="" value="{{ (isset($user->admin)) ? $user->id_number: ((isset($user->receptionist)) ? $user->id_number : '') }}">
														<div class="invalid-feedback">
															Please enter the ID Number.
														</div>
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="validationCustom08">Phone (SL)
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="validationCustom08" name="phone" placeholder="+94 000 0000" required=""value="{{ (isset($user->admin)) ? $user->phone: ((isset($user->receptionist)) ? $user->phone : '') }}">
														<div class="invalid-feedback">
															Please enter the mobile no.
														</div>
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="validationCustom08">Landline (SL)
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="validationCustom08" name="landline" placeholder="+11 000 0000"value="{{ (isset($user->admin)) ? $user->admin->landline: ((isset($user->receptionist)) ? $user->receptionist->landline : '') }}">
                                                    </div>
                                                </div>
                                                
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="validationCustom10">EPFnumber <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="validationCustom10" name="epfnumber" placeholder="E362" required=""value="{{ (isset($user->admin)) ? $user->epfnumber: ((isset($user->receptionist)) ? $user->epfnumber : '') }}">
														<div class="invalid-feedback">
															Please enter the EPFSnum.
														</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                        </div>
                    </div>
                    
                          
                                        
                                        
                                       
                                    
                       
                        



