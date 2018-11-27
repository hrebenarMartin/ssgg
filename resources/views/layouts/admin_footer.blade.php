<footer class="w3-theme w3-text-white" id="admin-footer">
    <div class="row">
        @if($user->access_level >= 1)
            <div class="col-md-4">
                Level 1 (User level)
            </div>
        @endif
        @if($user->access_level >= 2)
                <div class="col-md-4">
                    Level 2(Admin level)
                </div>
        @endif
        @if($user->access_level >= 3)
                <div class="col-md-4">
                    Level 3(Superadmin level)
                </div>
        @endif
    </div>
    @foreach($menu_items as $item)
        <a href="{{ url($item->route) }}">{{ $item->title }}</a>
    @endforeach
</footer>
