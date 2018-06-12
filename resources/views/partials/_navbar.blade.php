<nav class="navbar navbar-findcond navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('dashboard')}}">Memo</a>
        </div>
        @if(\Illuminate\Support\Facades\Auth::check())
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="/dashboard">Dashboard<span class="sr-only">(current)</span></a></li>
                    <li>
                        <?php $messages = \App\messages::where(['reciever_id'=> \Illuminate\Support\Facades\Auth::user()->id, 'read' => false])->get();?>
                        <a href="/dashboard/messages" ><i class="fa fa-fw fa-bell-o"></i>Messages <span class="badge" style="background-color: red">{{count($messages)}}</span></a>
                    </li>
                    <li class="active"><a href="#">Ana Sayfa <span class="sr-only">(current)</span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{\Illuminate\Support\Facades\Auth::user()->username}} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            {{--<li><a href="#">Geri bildirim</a></li>--}}
                            {{--<li><a href="#">Yardım</a></li>--}}
                            <li class="divider"></li>
                            {{--<li><a href="#">Ayarlar</a></li>--}}
                            <li><a href="/SignOut">Sign Out</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="navbar-form navbar-right search-form" role="search">
                    <input type="text" class="form-control" placeholder="Search" />
                    <button class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
                </form>
            </div>
        @else
            <form class="navbar-form" role="search">
                <a href="{{ url('/')}}" class="btn btn-primary">Login</a>
            </form>
        @endif
    </div>
</nav>