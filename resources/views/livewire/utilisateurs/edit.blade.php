<div class="row p-4 pt-5">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"> <i class="fas fa-user-plus fa-2x"></i>Formulaire de Modification</h3>
            </div>
            <form role="form" wire:submit.prevent="updateUser()">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Nom</label>
                                <input type="name" wire:model="editUser.nom" class="form-control @error('editUser.nom')
                                   is-invalid
                                @enderror">
                                @error('editUser.nom')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Prenom</label>
                                <input type="name" wire:model="editUser.prenom" class="form-control @error('editUser.prenom')
                                    is-invalid
                                @enderror" >
                                @error('editUser.prenom')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Sexe</label>
                        <select name="" id=""wire:model="editUser.sexe" class="form-control @error('editUser.sexe')
                            is-invalid
                        @enderror" >
                            <option value="">--------------</option>
                            <option value="H">Homme</option>
                            <option value="F">Femme</option>
                        </select>
                            @error('editUser.sexe')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Telephone</label>
                                <input type="name" wire:model="editUser.telephone" class="form-control @error('editUser.telephone')
                                    is-invalid
                                @enderror" >
                                @error('editUser.telephone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Adresse</label>
                                <input type="name" wire:model="editUser.adresse" class="form-control @error('editUser.adresse')
                                    is-invalid
                                @enderror" >
                                @error('editUser.adresse')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email"wire:model="editUser.email" class="form-control @error('editUser.email')
                            is-invalid
                        @enderror" >
                        @error('editUser.email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" disabled placeholder="Mot de Pass">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" wire:click="updateUser()" class="btn btn-primary">Modifier</button>
                    <button type="submit" wire:click.prevent="gotoListUser()" class="btn btn-danger">Retour à la Liste</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"> <i class="fas fa-key fa-2x"></i>Réinitialisation de Mot de pass</h3>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>
                                <a href="#" class="btn btn-link" wire:click.prevent="confirmPwdReset()" >Reinitialiser le mot de pass</a>
                                <button class="btn btn-primary" wire:click.prevent="confirmPwdReset()" >click</button>
                                <span>(par defaut : "password")</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="card-title flex-grow-1"> <i class="fas fa-fingerprint fa-2x"></i>Role & permission</h3>
                        <button class="btn bg-gradient-success" wire:click="updateRoleAndPermission">
                            <i class="fas fa-check"></i>
                            Appliquer les modifications
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="accordion">
                            @foreach($rolesPermissions["roles"] as $role)
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <h4 class="card-title flex-grow-1">
                                            <a date-parent="accordion" href="#" aria-expanded="true">
                                                {{ $role["role_nom"] }}
                                            </a>
                                        </h4>
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input type="checkbox" name="" id="customSwitch{{ $role["role_id"] }}" wire:model.lazy="rolesPermissions.roles.{{$loop->index}}.active" class="custom-control-input" @if($role["active"])
                                                checked
                                            @endif>
                                            <label for="customSwitch{{ $role["role_id"] }}" class="custom-control-label">{{ $role["active"] ? "Activé" : "Desactivé" }}</label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @json($rolesPermissions["roles"]);
                        </div>
                    </div>
                    <div class="pt-3">
                        <table class="table table-bordered">
                            <thead>
                                <th>Permission</th>
                                <th></th>
                            </thead>
                            <tbody class="">
                                @foreach($rolesPermissions["permissions"] as $permission)
                                    <tr>
                                        <td>{{ $permission["permission_nom"] }}</td>
                                        <td>
                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input type="checkbox" name="" id="customSwitchPermission{{ $permission["permission_id"] }}" wire:model.lazy="rolesPermissions.permissions.{{ $loop->index }}.active" class="custom-control-input" @if($permission["active"])
                                                    checked
                                                @endif>
                                                <label for="customSwitchPermission{{ $permission["permission_id"] }}" class="custom-control-label">{{ $permission["active"] ? "Activé" : "Desactivé" }}</label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                    @json($rolesPermissions["permissions"]);
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


