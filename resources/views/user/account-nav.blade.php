

          <ul class="account-nav">
            <li><a href="{{route('user.index')}}" class="menu-link menu-link_us-s">Панель керування</a></li>
            <li><a href="{{ route('user.orders') }}" class="menu-link menu-link_us-s">Замовлення</a></li>
            <li><a href="#" class="menu-link menu-link_us-s">Адреси</a></li>
            <li><a href="#" class="menu-link menu-link_us-s">Деталі облікового запису</a></li>
            <li><a href="#" class="menu-link menu-link_us-s">Список бажань</a></li>
            <li>
            <form method="POST" action="{{route('logout')}}" id="logout-form">
            @csrf
            <a href="{{route('logout')}}" class="menu-link menu-link_us-s" 
            onclick="event.preventDefault();document.getElementById('logout-form').submit();"><div class="text">Вихід</div></a>
          </form> 
        </li>
          </ul>
