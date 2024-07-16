<div class="container mt-5">
    <div class="component context-title mb-5">
        <h1>{{ $users->count() }} Nutzer</h1>
    </div>
    <x-component-table>

        @if ($users->count() > 0)
            <div class="component component-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                Name
                            </th>
                            <th>
                                E-Mail
                            </th>
                            <th>
                                Rollen
                            </th>
                            <th>
                                Aktiviert
                            </th>
                            <th class="right">
                                Aktion
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="nobr">
                                    <div class="content">{!! $user->getFullName() !!}</div>
                                </td>
                                <td>
                                    <div class="content">{!! $user->email !!}</div>
                                </td>
                                <td>
                                    @foreach ($user->roles as $role)
                                        <span class="badge bg-secondary">{!! $role->name !!}</span>
                                    @endforeach
                                </td>

                                <td class="expand">
                                    <div class="content">{!! isset($user->activated_at) ? '<i class="fa-solid fa-check"></i>' : '<i class="fa-solid fa-x"></i>' !!}</div>
                                </td>
                                <td class="action">
                                    @if ($user->activated_at === null)
                                        <a href="#" hx-get="{!! route('useradmin.user.confirmactivate', ['user' => $user->id]) !!}" hx-target="#modalcontainer"
                                            class="component-button btn btn-secondary"><i
                                                class="fas fa-check"></i><span>aktivieren</span></a>
                                    @endif
                                    <a href="{{ route('useradmin.user.edit', ['id' => $user->id]) }}"
                                        class="component-button btn btn-sm btn-primary"><i
                                            class="fas fa-edit"></i><span>ändern</span></a>

                                    <a href="#" hx-get="{!! route('useradmin.user.confirmdestroy', ['id' => $user->id]) !!}" hx-target="#modalcontainer"
                                        role="button" class="component-button btn btn-danger"><i
                                            class="fas fa-trash-alt"></i><span>entfernen</span></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="component component-context-info-value no-values">
                <div class="no-items">
                    <div class="icon">
                        <i class="fas fa-user-astronaut"></i>
                    </div>
                    <div class="context">
                        <p>Es sind keine User vorhanden.</p>
                    </div>
                </div>
            </div>
        @endif
</div>
</x-component-table>
