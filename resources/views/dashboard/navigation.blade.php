<form action="/search" method="POST" role="search">
    {{ csrf_field() }}
    <div class="input-group">
        <input type="text" class="form-control" name="keyword"
               placeholder="Search"> <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">
                        <span class="fa fa-search"></span>
                    </button>
                </span>
    </div>
</form>

<ul class="nav  flex-column userNav">

    <li class="nav-item">
        <a class="nav-link" href="/dashboard/items">Items</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/dashboard/vendors">Vendors</a>
    </li>
</ul>
