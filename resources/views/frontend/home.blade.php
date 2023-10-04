@extends('frontend.layouts.app')
@section('title','Wallet Pay')
@section('content')
   <div class="home" style="margin-top:40px;">
       <div class="row">
         <div class="col-12">
            <div class="profile">
                <img  class="mb-2" src="https://ui-avatars.com/api/?background=random&name={{ $user->name }}" alt="">
                <h6>{{ $user->name }}</h6>
                <p class="text-muted">{{ number_format($user->Wallet ? $user->Wallet->amount : 0 ) }} <span>MMK</span></p>
            </div>
         </div>
         <div class="col-6">
            <a href="{{ route('scan-and-pay') }}">
                <div class="card shortcut">
                <div class="card-body p-3">
                    <svg width="35px" height="35px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6.5 4C5.11929 4 4 5.11929 4 6.5V7C4 7.55228 3.55228 8 3 8C2.44772 8 2 7.55228 2 7V6.5C2 4.01472 4.01472 2 6.5 2H7C7.55228 2 8 2.44772 8 3C8 3.55228 7.55228 4 7 4H6.5Z" fill="#5842E3"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M10.9598 6C10.294 5.99998 9.73444 5.99997 9.27657 6.03738C8.79785 6.07649 8.34289 6.16143 7.91103 6.38148C7.25247 6.71703 6.71703 7.25247 6.38148 7.91103C6.16143 8.34289 6.07649 8.79785 6.03738 9.27657C6.01958 9.49452 6.01025 9.73549 6.00536 10H4C3.44772 10 3 10.4477 3 11C3 11.5523 3.44772 12 4 12H20C20.5523 12 21 11.5523 21 11C21 10.4477 20.5523 10 20 10H17.9946C17.9898 9.73549 17.9804 9.49451 17.9626 9.27657C17.9235 8.79785 17.8386 8.34289 17.6185 7.91103C17.283 7.25247 16.7475 6.71703 16.089 6.38148C15.6571 6.16143 15.2021 6.07649 14.7234 6.03738C14.2656 5.99997 13.706 5.99998 13.0402 6H10.9598ZM15.9943 10C15.99 9.7843 15.9825 9.60112 15.9693 9.43944C15.9403 9.0844 15.889 8.92194 15.8365 8.81901C15.6927 8.53677 15.4632 8.3073 15.181 8.16349C15.0781 8.11105 14.9156 8.05975 14.5606 8.03074C14.1938 8.00078 13.7166 8 13 8H11C10.2834 8 9.80615 8.00078 9.43944 8.03074C9.0844 8.05975 8.92194 8.11105 8.81901 8.16349C8.53677 8.3073 8.3073 8.53677 8.16349 8.81901C8.11105 8.92194 8.05975 9.0844 8.03074 9.43944C8.01753 9.60112 8.00999 9.7843 8.00569 10H15.9943Z" fill="#5842E3"></path> <path d="M14.0757 18L10.9598 18C10.2941 18 9.7344 18 9.27657 17.9626C8.79785 17.9235 8.34289 17.8386 7.91103 17.6185C7.25247 17.283 6.71703 16.7475 6.38148 16.089C6.34482 16.017 6.32528 15.9835 6.29997 15.9401C6.28429 15.9132 6.26639 15.8825 6.24083 15.8365C6.17247 15.7135 6.09846 15.5585 6.05426 15.342C6.01816 15.1651 6.00895 14.9784 6.00455 14.795C6 14.6058 6 14.3522 6 14.0159V14C6 13.4477 6.44772 13 7 13C7.55229 13 8 13.4477 8 14C8 14.3558 8.00007 14.5848 8.00397 14.7469C8.0058 14.823 8.00837 14.872 8.01047 14.9021C8.04313 14.9585 8.10631 15.0688 8.16349 15.181C8.3073 15.4632 8.53677 15.6927 8.81901 15.8365C8.92194 15.889 9.0844 15.9403 9.43944 15.9693C9.80615 15.9992 10.2834 16 11 16H14C14.5027 16 14.6376 15.9969 14.7347 15.9815C15.3765 15.8799 15.8799 15.3765 15.9815 14.7347C15.9969 14.6376 16 14.5027 16 14C16 13.4477 16.4477 13 17 13C17.5523 13 18 13.4477 18 14L18 14.0757C18.0002 14.4657 18.0003 14.7734 17.9569 15.0475C17.7197 16.5451 16.5451 17.7197 15.0475 17.9569C14.7734 18.0003 14.4657 18.0002 14.0757 18Z" fill="#5842E3"></path> <path d="M22 17C22 16.4477 21.5523 16 21 16C20.4477 16 20 16.4477 20 17V17.5C20 18.8807 18.8807 20 17.5 20H17C16.4477 20 16 20.4477 16 21C16 21.5523 16.4477 22 17 22H17.5C19.9853 22 22 19.9853 22 17.5V17Z" fill="#5842E3"></path> <path d="M16 3C16 2.44772 16.4477 2 17 2H17.5C19.9853 2 22 4.01472 22 6.5V7C22 7.55228 21.5523 8 21 8C20.4477 8 20 7.55228 20 7V6.5C20 5.11929 18.8807 4 17.5 4H17C16.4477 4 16 3.55228 16 3Z" fill="#5842E3"></path> <path d="M4 17C4 16.4477 3.55228 16 3 16C2.44772 16 2 16.4477 2 17V17.5C2 19.9853 4.01472 22 6.5 22H7C7.55228 22 8 21.5523 8 21C8 20.4477 7.55228 20 7 20H6.5C5.11929 20 4 18.8807 4 17.5V17Z" fill="#5842E3"></path> </g></svg>
                    <span>Scan & Pay</span>
                    </div>
                </div>
            </a>
         </div>
         <div class="col-6">
            <a href="{{route('receive-qr')}}">
                <div class="card shortcut">
                    <div class="card-body p-3">
                        <svg fill="#5842E3" width="35px" height="35px" viewBox="0 -0.09 122.88 122.88" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="enable-background:new 0 0 122.88 122.7" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css">.st0{fill-rule:evenodd;clip-rule:evenodd;}</style> <g> <path class="st0" d="M0.18,0h44.63v44.45H0.18V0L0.18,0z M111.5,111.5h11.38v11.2H111.5V111.5L111.5,111.5z M89.63,111.48h11.38 v10.67H89.63h-0.01H78.25v-21.82h11.02V89.27h11.21V67.22h11.38v10.84h10.84v11.2h-10.84v11.2h-11.21h-0.17H89.63V111.48 L89.63,111.48z M55.84,89.09h11.02v-11.2H56.2v-11.2h10.66v-11.2H56.02v11.2H44.63v-11.2h11.2V22.23h11.38v33.25h11.02v11.2h10.84 v-11.2h11.38v11.2H89.63v11.2H78.25v22.05H67.22v22.23H55.84V89.09L55.84,89.09z M111.31,55.48h11.38v11.2h-11.38V55.48 L111.31,55.48z M22.41,55.48h11.38v11.2H22.41V55.48L22.41,55.48z M0.18,55.48h11.38v11.2H0.18V55.48L0.18,55.48z M55.84,0h11.38 v11.2H55.84V0L55.84,0z M0,78.06h44.63v44.45H0V78.06L0,78.06z M10.84,88.86h22.95v22.86H10.84V88.86L10.84,88.86z M78.06,0h44.63 v44.45H78.06V0L78.06,0z M88.91,10.8h22.95v22.86H88.91V10.8L88.91,10.8z M11.02,10.8h22.95v22.86H11.02V10.8L11.02,10.8z"></path> </g> </g></svg>
                        <span>Receive QR</span>
                    </div>
                </div>
            </a>
         </div>
         <div class="col-12">
         <div class="card my-3 function-box">
            <div class="card-body">
                <a href="{{ route('transfer') }}" class="d-flex justify-content-between update-password">
                    <span><svg fill="#5842E3" height="35px" width="35px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 496 496" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <g> <path d="M264,136h-16V96h16V64v-8V43.288L186.072,0h-20.144L88,43.288V56v8v32h16v40H88v48h176V136z M170.072,16h11.856 l57.592,32H112.48L170.072,16z M104,64h144v16H104V64z M232,96v40h-16V96H232z M200,96v40h-16V96H200z M168,96v40h-16V96H168z M136,96v40h-16V96H136z M248,168H104v-16h144V168z"></path> <polygon points="336,224 352,224 352,64 280,64 280,80 336,80 "></polygon> <path d="M336,480H80v-64H16V80h56V64H0v363.312L68.688,496H352v-64h-16V480z M64,468.688L27.312,432H64V468.688z"></path> <path d="M288,224c-57.344,0-104,46.656-104,104s46.656,104,104,104s104-46.656,104-104S345.344,224,288,224z M288,416 c-48.52,0-88-39.48-88-88c0-48.52,39.48-88,88-88s88,39.48,88,88C376,376.52,336.52,416,288,416z"></path> <path d="M272,288h32c8.816,0,16,7.176,16,16h16c0-17.648-14.352-32-32-32h-8v-16h-16v16h-8c-17.648,0-32,14.352-32,32 s14.352,32,32,32h32c8.816,0,16,7.176,16,16c0,8.824-7.184,16-16,16h-32c-8.824,0-16-7.176-16-16h-16c0,17.648,14.352,32,32,32h8 v16h16v-16h8c17.648,0,32-14.352,32-32s-14.352-32-32-32h-32c-8.824,0-16-7.176-16-16C256,295.176,263.176,288,272,288z"></path> <polygon points="470.168,264 453.032,288 400,288 400,304 441.6,304 433.488,315.352 446.504,324.648 489.824,264 446.504,203.352 433.488,212.648 441.6,224 368,224 368,240 453.032,240 "></polygon> <polygon points="496,368 496,352 430.4,352 438.504,340.648 425.488,331.352 382.168,392 425.488,452.648 438.504,443.352 430.4,432 496,432 496,416 418.968,416 401.824,392 418.968,368 "></polygon> <polygon points="176,368 176,352 134.4,352 142.504,340.648 129.488,331.352 86.168,392 129.488,452.648 142.504,443.352 134.4,432 216,432 216,416 122.968,416 105.824,392 122.968,368 "></polygon> <polygon points="137.488,315.352 150.504,324.648 193.824,264 150.504,203.352 137.488,212.648 145.6,224 80,224 80,240 157.032,240 174.168,264 157.032,288 80,288 80,304 145.6,304 "></polygon> </g> </g> </g> </g></svg>Transfer</span>
                    <span><svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10 7L15 12L10 17" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></span>
                </a>
                <hr>
                <a href="{{ route('wallet') }}" class="d-flex justify-content-between">
                    <span><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" width="35px" height="35px" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#D3D7DF;" d="M396.8,448H115.2v51.2H448V64h-51.2V448z"></path> <path style="fill:#E9EBEF;" d="M64,12.8V448h332.8V12.8H64z"></path> <g> <path style="fill:#5842E3;" d="M311.134,296.926v-49.579c3.447,0.802,6.4,2.048,8.764,3.746c4.702,3.524,7.151,8.721,7.484,15.701 c0,4.173,1.348,7.646,4.036,10.325c4.847,4.821,13.841,4.599,17.997-0.051c2.628-2.671,3.959-6.153,3.959-10.274 c0-13.124-4.574-23.902-13.636-32.102c-7.509-6.647-17.126-10.752-28.612-12.151v-6.05c0-7.1-4.676-11.699-11.913-11.699 c-7.1,0-11.691,4.599-11.691,11.699v5.999c-11.537,1.323-21.35,5.427-29.21,12.151c-10.24,8.926-15.428,20.821-15.428,35.422 c0,12.774,4.702,23.228,13.935,31.078c7.091,6.101,17.135,10.871,30.703,14.524v53.623c-5.897-1.246-10.641-3.354-14.114-6.221 c-6.101-5.171-9.011-12.851-8.892-23.526c0-4.096-1.263-7.552-3.541-9.822c-4.489-5.026-13.739-4.873-17.801-0.247 c-2.509,2.5-3.789,5.871-3.789,10.078c0,19.473,6.025,34.099,17.954,43.529c7.339,5.521,17.476,9.225,30.174,11.025v10.351 c0,7.228,4.591,11.904,11.691,11.904c7.236,0,11.913-4.676,11.913-11.904v-10.129c12.066-1.852,22.451-6.451,30.925-13.696 c10.854-9.301,16.358-21.376,16.358-35.857c0-13.679-4.864-24.602-14.438-32.452C336.922,306.449,326.178,301.423,311.134,296.926z M287.539,290.15c-5.948-2.176-10.385-4.753-13.235-7.646c-3.49-3.601-5.188-8.149-5.188-13.952c0-7.074,2.526-12.271,7.936-16.324 c3.012-2.253,6.528-3.874,10.487-4.898V290.15z M322.961,363.477c-3.439,2.551-7.398,4.429-11.827,5.623v-46.549 c9.062,2.85,13.312,5.478,15.309,7.296c3.661,3.226,5.513,8.704,5.513,16.222C331.964,353.553,329.114,359.074,322.961,363.477z"></path> <path style="fill:#5842E3;" d="M51.2,0v460.8h51.2V512h358.4V51.2h-51.2V0H51.2z M76.8,435.2V25.6H384v409.6H76.8z M435.2,76.8 v409.6H128v-25.6h281.6v-384H435.2z"></path> <rect x="102.4" y="51.2" style="fill:#5842E3;" width="256" height="25.6"></rect> <rect x="102.4" y="153.6" style="fill:#5842E3;" width="76.8" height="25.6"></rect> <rect x="102.4" y="358.4" style="fill:#5842E3;" width="76.8" height="25.6"></rect> <rect x="102.4" y="102.4" style="fill:#5842E3;" width="128" height="25.6"></rect> <rect x="256" y="102.4" style="fill:#5842E3;" width="102.4" height="25.6"></rect> </g> </g></svg>Wallet</span>
                    <span><svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10 7L15 12L10 17" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></span>
                </a>
                <hr>
                <a href="{{ route('transaction') }}" class="d-flex justify-content-between">
                    <span><svg width="35px" height="35px" viewBox="0 0 64 64" id="icons" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><defs><style>.cls-1{fill:#5842E3;}</style></defs><title></title><path class="cls-1" d="M52,7H12a6,6,0,0,0-6,6V51a6,6,0,0,0,6,6H52a6,6,0,0,0,6-6V13A6,6,0,0,0,52,7Zm2,44a2,2,0,0,1-2,2H12a2,2,0,0,1-2-2V13a2,2,0,0,1,2-2H52a2,2,0,0,1,2,2Z"></path><path class="cls-1" d="M45,29a2,2,0,0,0,0-4H22.83l2.58-2.59a2,2,0,0,0-2.82-2.82l-6,6a2,2,0,0,0-.44,2.18A2,2,0,0,0,18,29Z"></path><path class="cls-1" d="M47,36H20a2,2,0,0,0,0,4H42.17l-2.58,2.59a2,2,0,1,0,2.82,2.82l6-6a2,2,0,0,0,.44-2.18A2,2,0,0,0,47,36Z"></path></g></svg>Transaction</span>
                    <span><svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10 7L15 12L10 17" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></span>
                </a>
            </div>
        </div>
         </div>
       </div>
   </div>         
@endsection
