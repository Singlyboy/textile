<div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                            <ul class="nav flex-column">
                            <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center gap-2" href="{{route('dashboard')}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mortarboard" viewBox="0 0 16 16">
  <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917zM8 8.46 1.758 5.965 8 3.052l6.242 2.913z"/>
  <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46z"/>
</svg>
                                        Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                  
                                </li>
                               
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center gap-2" href="{{route('category.list')}}">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="16"
                                            height="16"
                                            fill="currentColor"
                                            class="bi bi-bar-chart-steps"
                                            viewbox="0 0 16 16">
                                            <path
                                                d="M.5 0a.5.5 0 0 1 .5.5v15a.5.5 0 0 1-1 0V.5A.5.5 0 0 1 .5 0M2 1.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1-.5-.5zm2 4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zm2 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-6a.5.5 0 0 1-.5-.5zm2 4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                        Category
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center gap-2" href="{{route('parts.list')}}">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="16"
                                            height="16"
                                            fill="currentColor"
                                            class="bi bi-bullseye"
                                            viewbox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M8 13A5 5 0 1 1 8 3a5 5 0 0 1 0 10m0 1A6 6 0 1 0 8 2a6 6 0 0 0 0 12"/>
                                            <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6m0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8"/>
                                            <path d="M9.5 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                                        </svg>
                                        Parts
                                    </a>
                                </li>
                               

                                
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center gap-2" href="{{route('customer.list')}}">
                                        <svg class="bi"><use xlink:href="#people"/></svg>
                                        Customer
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center gap-2" href="{{route('order.list')}}">
                                        <svg class="bi"><use xlink:href="#file-earmark"/></svg>
                                        Orders
                                    </a>
                                </li>
                               

                        
                                
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center gap-2" href="{{route('report.list')}}">
                                        <svg class="bi"><use xlink:href="#graph-up"/></svg>
                                        Reports
                                    </a>
                                </li>

                            </ul>

                            <hr class="my-3">

                            <ul class="nav flex-column mb-auto">
                                
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center gap-2" href="{{route('logout')}}">
                                        <svg class="bi"><use xlink:href="#door-closed"/></svg>
                                        Sign out
                                    </a>
                                </li>
                            </ul>
                        </div>