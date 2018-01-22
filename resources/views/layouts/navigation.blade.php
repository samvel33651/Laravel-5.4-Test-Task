<div  style="margin-bottom: 25px;">
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
</div>
@include('layouts.errors')
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