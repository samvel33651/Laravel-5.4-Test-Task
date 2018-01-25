<ul class="nav  flex-column ">
    @if(auth()->user()->isAdmin ===1)
        <li class="nav-item">
            <a class="nav-link active" href="/users">Manage Users <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/types">Types</a>
        </li>
    @endif
    <li class="nav-item">
        <a class="nav-link" href="/items">Items</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/vendors">Vendors</a>
    </li>
</ul>