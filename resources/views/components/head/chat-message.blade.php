@php
    use Illuminate\Support\Facades\Auth;
    use App\Enums\online_medicine\ObjectOnlineMedicine;
@endphp

<link href="{{ asset('css/chatmessage.css') }}" rel="stylesheet">

<style>
    .spinner-icon {
        display: none;
        font-size: 14px;
        animation: spin 2s linear infinite;
        position: absolute;
        right: 10px;
        top: 30%;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .frame.component-medicine.w-100 {
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
    }

    .max-1-line-title-widget-chat {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    @media (max-width: 575px) {
        .div .div-2 a .text-wrapper {
            font-size: 12px;
        }

        .text-wrapper-4 {
            font-size: 12px !important;
        }
    }


    .find-my-medicine-2 .frame {
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        position: relative;
        background-color: #088180;
        border-radius: 24px;
        border: 1px solid;
        border-color: var(--grey-medium);
    }

    .find-my-medicine-2 .frame .rectangle {
        position: relative;
        object-fit: cover;
    }

    .find-my-medicine-2 .frame .div {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 16px;
        position: relative;
        align-self: stretch;
        width: 100%;
        flex: 0 0 auto;
    }

    .find-my-medicine-2 .frame .div-2 {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
        padding: 0px 16px;
        position: relative;
        align-self: stretch;
        width: 100%;
        flex: 0 0 auto;
    }

    .find-my-medicine-2 .frame .text-wrapper {
        position: relative;
        width: fit-content;
        margin-top: -1px;
        font-weight: var(--body-1-extra-font-weight);
        color: var(--white);
        font-size: var(--body-1-extra-font-size);
        text-align: center;
        letter-spacing: var(--body-1-extra-letter-spacing);
        line-height: var(--body-1-extra-line-height);
        font-style: var(--body-1-extra-font-style);
    }

    .find-my-medicine-2 .frame .text-wrapper-3 {
        position: relative;
        width: fit-content;
        font-weight: var(--subtitle-1-extra-font-weight);
        color: var(--white);
        font-size: var(--subtitle-1-extra-font-size);
        text-align: center;
        letter-spacing: var(--subtitle-1-extra-letter-spacing);
        line-height: var(--subtitle-1-extra-line-height);
        font-style: var(--subtitle-1-extra-font-style);
    }

    .find-my-medicine-2 .frame .div-wrapper {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 16px 40px;
        position: relative;
        flex: 0 0 auto;
        margin-bottom: -1px;
        margin-right: -1px;
        background-color: var(--white);
        border-radius: 60px 0px 24px 0px;
        overflow: hidden;
    }

    .find-my-medicine-2 .frame .text-wrapper-4 {
        position: relative;
        width: fit-content;
        font-weight: var(--subtitle-1-extra-font-weight);
        color: var(--black);
        font-size: var(--subtitle-1-extra-font-size);
        letter-spacing: var(--subtitle-1-extra-letter-spacing);
        line-height: var(--subtitle-1-extra-line-height);
        font-style: var(--subtitle-1-extra-font-style);
    }

    .find-my-medicine-2 .frame .img {
        position: absolute;
        width: 24px;
        height: 24px;
        top: 20px;
        left: 225px;
    }


    .find-my-medicine-2 .text-wrapper.text-ellipsis {
        text-overflow: ellipsis;
    }


    .find-my-medicine-2 .border-img {
        border-radius: 13px 13px 100px 0px;
        object-fit: cover;
    }

    .find-my-medicine .frame:hover,
    .find-my-medicine-2 .frame:hover {
        border-radius: 22px;
        background: #088180;
        box-shadow: 0px 8px 10px 0px rgba(0, 0, 0, 0.25);
    }


    /* General button style */
    #widget-chat .btn {
        border: none;
        font-family: 'Lato';
        font-size: inherit;
        color: inherit;
        background: none;
        cursor: pointer;
        display: inline-block;
        letter-spacing: 1px;
        outline: none;
        position: relative;
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        transition: all 0.3s;
    }

    #widget-chat .btn:after {
        content: '';
        position: absolute;
        z-index: -1;
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        transition: all 0.3s;
    }

    /* Pseudo elements for icons */
    #widget-chat .btn:before {
        font-family: 'FontAwesome';
        speak: none;
        font-style: normal;
        font-weight: normal;
        font-variant: normal;
        text-transform: none;
        line-height: 1;
        position: relative;
        -webkit-font-smoothing: antialiased;
    }


    #widget-chat .btn-sep:before {
        background: rgba(0, 0, 0, 0.15);
    }

    /* Button 1 */
    #widget-chat .btn-1 {
        background: #3498db;
        color: #fff;
        padding-left: 30px;
    }

    #widget-chat .btn-1:hover {
        background: #2980b9;
    }

    #widget-chat .btn-1:active {
        background: #2980b9;
        top: 2px;
    }

    #widget-chat .btn-1:before {
        position: absolute;
        height: 100%;
        left: 0;
        top: 0;
        line-height: 2;
        width: 25px;
    }

    /* Button 2 */
    #widget-chat .btn-2 {
        background: #2ecc71;
        color: #fff;
        padding-left: 30px;
        font-size: 12px;
    }

    #widget-chat .btn-2:hover {
        background: #27ae60;
    }

    #widget-chat .btn-2:active {
        background: #27ae60;
        top: 2px;
    }

    #widget-chat .btn-2:before {
        position: absolute;
        height: 100%;
        left: 0;
        top: 0;
        line-height: 2;
        width: 25px;
    }

    /* Icons */

    #widget-chat .icon-cart:before {
        content: "\f07a";
    }

    #widget-chat .icon-info:before {
        content: "\f05a";
    }

    .box-order-chat {
        width: 100%;
        margin: 0 auto;
        background: #0f5132;
        padding: 10px;
        border-radius: 16px;
    }

    .title-name {
        font-size: 12px;
        color: black;
        margin-bottom: 5px;
    }

    .content-order-chat {
        font-size: 12px;
        color: black;
        margin-bottom: 5px;
        font-weight: bold;
        margin-left: 7px;
    }

    .content-order-item {
        width: 100%;
        background: white;
        padding: 10px;
        border-radius: 16px;
    }

    #widget-chat #chat-messages div.message.right {
        margin-right: 0;
        padding: 0px 20px 30px 0;
    }

    #widget-chat #chat-messages div.message {
        padding: 0px 10px 30px 10px;
    }

    .bubble {
        overflow-wrap: anywhere;
    }
    .box-cskh{
        width: 60px;
        position: fixed;
        right: 30px;
        bottom: 80px;
        z-index: 1;
    }
    .image-sent{
        object-fit: contain;
        height: auto;
        max-height: 200px;
        width: 180px !important;
        margin-right: 0 !important;
        border-radius: 0 !important;
    }
    @media (max-width: 992px) {
        .modal.show .modal-dialog-cskh{
            width: 70%!important;
        }
    }
    @media (max-width: 767px) {
        .modal.show .modal-dialog-cskh{
            width: 95%!important;
            margin: 10px auto!important;
        }
        .box-cskh{
            right: 25px;
        }
    }
</style>
{{--<div class="box-cskh" data-bs-toggle="modal" data-bs-target="#exampleModalCSKH">--}}
{{--    <img src="{{asset('img/icon-cskh.png')}}" class="w-100" style="border-radius: 50%">--}}
{{--</div>--}}
<div id="widget-chat">

    <div id="chat-circle" class="btn btn-raised">
        <div id="chat-overlay"></div>
        <i class="fa-solid fa-comment-dots mr-2"></i>
        Tin nhắn
    </div>

    <div class="chat-box" id="chat-box-mess">
        <div class="chat-box-header">
            <p class="h6 mb-0"><strong>Tin nhắn</strong></p>
            <span class="chat-box-toggle"><i class="fa-solid fa-x" style="font-size: 14px;"></i></span>
        </div>
        <div class="chat-box-body">

            <ul class="nav nav-tabs" role="tablist" id="chat-widget-navbar" style="margin-top: 15px">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="chat-widget-all-online" data-toggle="tab"
                            data-target="#chat-widget-all-online-tabs" type="button" role="tab" aria-controls="home"
                            aria-selected="true">Bác sĩ
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="chat-widget-connected" data-toggle="tab"
                            data-target="#chat-widget-connected-tabs" type="button" role="tab" aria-controls="profile"
                            aria-selected="false">Tin nhắn đã gửi
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="chat-widget-all-online-tabs" role="tabpanel"
                     aria-labelledby="chat-widget-all-online">
                    <div class="search-container d-flex justify-content-between">
                        <i class="fa fa-search search-icon"></i>
                        <input type="text" placeholder="Tìm kiếm" class="chat-search w-100" id="searchDoctor" />
                        <i class="fa-solid fa-spinner spinner-icon"></i>
                    </div>
                    <div id="friendslist-all-online">
                        <div id="friends-all-online"></div>
                    </div>
                </div>
                <div class="tab-pane fade" id="chat-widget-connected-tabs" role="tabpanel"
                     aria-labelledby="chat-widget-connected">
                     <div class="search-container">
                        <i class="fa fa-search search-icon"></i>
                        <input type="text" placeholder="Tìm kiếm" class="chat-search w-100" id="searchDoctorChat" />
                    </div>
                    <div id="friendslist-connected">
                        <div id="friends-connected"></div>
                    </div>
                </div>

            </div>

            <div id="chatview" class="p1">
                <div id="profile">
                    <div id="close">
                        <i class="fa-solid fa-arrow-left" style="color: black"></i>
                    </div>

                    <div class="d-flex">
                        <img class="chatview-image" id="chatview-image" src=""/>
                        <div>
                            <p class="mt-0"></p>
                            <label style="color: black; font-size: 11px; text-align: left; display: flex; align-items: center; column-gap: 3px">
                                <div id="online-div" style="display: none">
                                    <div class="d-flex" style="align-items: center; gap: 5px;">Online <div class="online-dot" ></div></div>
                                </div>
                                <div id="offline-div" style="display: none">
                                    <div class="d-flex" style="align-items: center; gap: 5px;">Offline <div class="offline-dot"></div></div>
                                </div>
                            </label>

                        </div>
                    </div>
{{--                    <span></span>--}}
                </div>
                <div id="chat-messages"></div>

                <div id="sendmessage">
                    <input type="text" value="Send message..." id="msger-input" onkeypress="supSendMessage()"/>
                    <div id="image-preview" style="display: none"></div>
                    @if (!\App\Models\User::isNormal())
                        <span class="mr-1" style="padding: 15px 9px" data-toggle="modal"
                              data-target="#modal-create-don-thuoc-widget-chat"><i
                                class="fa-solid fa-plus"></i></span>
                    @endif
                    <span id="send-chatMessage">
                        <i class="fa-solid fa-paperclip mr-3 file-send-btn"></i>
                        <input type="file" id="file-input" style="display: none;">
                        <i class="fa-regular fa-paper-plane msger-send-btn"></i>
                    </span>
                </div>
            </div>

        </div>


    </div>
</div>

<div class="modal fade" id="modal-create-don-thuoc-widget-chat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content overflow-scroll">
            <div class="modal-header">
            </div>
            <form id="prescriptionForm" method="post">
                @csrf
                <div class="modal-body">

                    <input type="hidden" name="created_by" value="{{ Auth::id() }}">
                    <div class="list-service-result mt-2 mb-3">
                        <div id="list-service-result">

                        </div>
                        <button type="button" class="btn btn-outline-primary mt-3 btn-add-medicine">{{ __('home.Add') }}
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary createPrescription_widgetChat">Tạo</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-add-medicine-widget-chat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header ">
                <form class="row w-100">
                    <div class="col-sm-4">
                        <div class="form-group position-relative">
                            <label for="inputSearchNameMedicine" class="form-control-feedback"></label>
                            <input type="search" id="inputSearchNameMedicine" class="form-control handleSearchMedicine"
                                   placeholder="Tìm kiếm theo tên thuốc">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group position-relative">
                            <label for="inputSearchDrugIngredient" class="form-control-feedback"></label>
                            <input type="search" id="inputSearchDrugIngredient"
                                   class="form-control handleSearchMedicine"
                                   placeholder="Tìm kếm theo thành phần thuốc">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group position-relative">
                            <label for="inputSearchNameMedicine" class="form-control-feedback"></label>
                            <select class="form-select position-relative handleSearchMedicineChange" id="object_search"
                            >
                                <option value="{{ \App\Enums\online_medicine\ObjectOnlineMedicine::KIDS }}">
                                    {{ __('home.For kids') }}</option>
                                <option value="{{ ObjectOnlineMedicine::FOR_WOMEN }}">{{ __('home.For women') }}
                                </option>
                                <option value="{{ ObjectOnlineMedicine::FOR_MEN }}">{{ __('home.For men') }}</option>
                                <option value="{{ ObjectOnlineMedicine::FOR_ADULT }}">{{ __('home.For adults') }}
                                </option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-body find-my-medicine-2">
                <div class="row" id="modal-list-medicine-widget-chat">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal CSKH-->
<div class="modal fade" id="exampleModalCSKH" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-cskh">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0f5132;padding: 10px">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-size: 15px!important;color: white">Tư vấn, hỏi đáp, chăm sóc khách hàng</h1>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark" style="color: #ffffff;font-size: 20px"></i></button>
            </div>
            <div class="modal-body">
                    <lable>Email</lable>
                    <input type="text" name="email" id="emails" class="form-control mb-3" placeholder="Email" required>
                <lable>Họ và tên</lable>
                <input type="text" name="user_name" id="user_names" class="form-control mb-3" placeholder="Họ và tên" required>
                <lable>Số điện thoại</lable>
                <input type="number" name="phone" id="phones" class="form-control mb-3" required>
                <lable>Nội dung</lable>
                <textarea name="content" id="contentes" required class="w-100 form-textarea" rows="6"></textarea>
                <div class="mt-3 d-flex justify-content-center">
                    <button class="btn btn-send-mail" style="background-color: #159d68;color: white;padding: 7px 25px">Gửi</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="{{ asset('laravel-echo@1.11.2/dist/echo.iife.js') }}"></script>

<script>
    function isValidEmail(email) {
        const re = /\S+@\S+\.\S+/;
        return re.test(email);
    }

    function isValidPhone(phone) {
        const re = /^[0-9]{10,11}$/;
        return re.test(phone);
    }
    $('.btn-send-mail').on('click', function () {
        const email = $('#emails').val();
        const userName = $('#user_names').val();
        const phone = $('#phones').val();

        if (!email || !userName || !phone) {
            alert('Vui lòng điền đầy đủ thông tin.');
            return;
        }

        if (!isValidEmail(email)) {
            alert('Vui lòng nhập địa chỉ email hợp lệ.');
            return;
        }

        if (!isValidPhone(phone)) {
            alert('Vui lòng nhập số điện thoại hợp lệ.');
            return;
        }
        const formData = new FormData();
        formData.append("email",email);
        formData.append("user_name", userName);
        formData.append("phone", phone);
        const fieldTextareaTiny = ["contentes"];
        fieldTextareaTiny.forEach(fieldTextarea => {
            const content = tinymce.get(fieldTextarea).getContent();
            formData.append(fieldTextarea, content);
        });

        const csrfTokens = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: `{{ route('mail-cskh') }}`,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfTokens
            },
            contentType: false,
            cache: false,
            processData: false,
            data: formData,
            success: function(response) {
                $('#exampleModalCSKH').modal('hide');
                alert(response.data);
            },
            error: function(xhr) {
                if (xhr.status == 400 || xhr.status == 404) {
                    alert('Update error!');
                } else {
                    alert('Error, Please try again!');
                }
            }
        });
    })
    function supSendMessage() {
        if (event.keyCode === 13 && !event.shiftKey) {
            $('.msger-send-btn').trigger('click');
        }
    }

    function setCookie(name, value, hours) {
        var expires = 5;
        if (hours) {
            var date = new Date();
            date.setTime(date.getTime() + (hours * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    function getCookie(name) {
        let cookies = document.cookie.split(';').map(cookie => cookie.trim());
        for (let i = 0; i < cookies.length; i++) {
            let cookie = cookies[i];
            if (cookie.startsWith(name + '=')) {
                return cookie.substring(name.length + 1);
            }
        }
        return null;
    }
    checkHomePageAndToggleDisplay();
    function checkHomePageAndToggleDisplay() {
        let chatCircle = document.getElementById('chat-circle');
        let chatBoxes = document.getElementById('chat-box-mess');
        // if (window.location.href === window.location.origin || window.location.pathname === '/') {
        //     chatCircle.style.display = 'none';
        //     chatBoxes.style.display = 'block';
        // }
    }

</script>

<script type="module">
    const CHAT_TYPE_ALL_ONLINE = 'all-online';
    const CHAT_TYPE_CONNECTED = 'connected';

    let chatUserId;
    let emailUser;
    let isShowOpenWidget;
    let uuid_session;
    let elementInputMedicine_widgetChat;
    let next_elementInputMedicine_widgetChat;
    let next_elementQuantity_widgetChat;
    let next_elementMedicineIngredients_widgetChat;

    let currentUserIdChat = '{{ Auth::check() ? Auth::user()->id : '' }}';

    let totalMessageUnseen = 0;

    // window.Echo = new Echo({
    //     broadcaster: 'pusher',
    //     key: 'e700f994f98dbb41ea9f',
    //     cluster: 'eu',
    //     forceTLS: true,
    //     encrypted: true,
    // });

    // window.Echo.channel("messages." + currentUserIdChat).listen('NewMessage', function (e) {
    //     renderMessageReceive(e);
    //     // handleSeenMessage();
    //     calculateTotalMessageUnseen(e);
    // });

    import {firebaseConfig} from '{{ asset('constants.js') }}';
    import {initializeApp} from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";
    import {
        collection,
        getDocs,
        updateDoc,
        doc,
        onSnapshot,
        setDoc,
        getFirestore,
        getDoc,
        where,
        query,
    } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-firestore.js";
    import {
        getAuth,
        signInWithEmailAndPassword,
        createUserWithEmailAndPassword,
        signOut
    } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-auth.js";
    import {
        getMessaging,
        getToken,
    } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-messaging.js";
    import {
        getStorage,
        ref,
        uploadBytes,
        getDownloadURL
    } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-storage.js";

    const app = initializeApp(firebaseConfig);
    const database = getFirestore(app);
    const auth = getAuth();
    // const messaging = getMessaging(app);
    const storage = getStorage(app);
    let messaging;
    try {
        messaging = getMessaging(app);
    } catch (err) {
        console.error('Failed to initialize Firebase Messaging', err);
    }

    let current_user, list_user = [], doctorChatList = [], list_user_not_seen = [],
        current_role = `{{ (new \App\Http\Controllers\MainController())->getRoleUser(Auth::user()->id)}}`,
        user_chat;

    const usersCollection = collection(database, "users");

    const chatsCollection = collection(database, "chats");

    if (!current_user){
        login();
    }

    async function login() {
        try {
            const userCredential = await signInWithEmailAndPassword(auth, `{{ Auth::user()->email }}`, '123456');
            current_user = userCredential.user;

            const userDocRef = doc(database, "users", current_user.uid);
            const userDoc = await getDoc(userDocRef);

            if (!userDoc.exists()) {
                await createUserInFirestore(current_user);
                await updateFirebaseToken();
            }

            let uid = current_user.uid;
            setOnline(uid, true);
            setCookie("is_login", true, 1);
            getAllChatRoomWithDoctor();
        } catch (error) {
            console.error('Login error:', error);
            registerUser();
        }
    }

    async function registerUser() {
        try {
            const userCredential = await createUserWithEmailAndPassword(auth, `{{ Auth::user()->email }}`, '123456');
            current_user = userCredential.user;
            await createUserInFirestore(current_user);
            await updateFirebaseToken();
        } catch (error) {
            console.error('Register error:', error);
        }
    }

    async function createUserInFirestore(user) {
        const time = Date.now().toString();
        const chatUser = {
            id: user.uid,
            name: `{{ Auth::user()->username }}`,
            email: user.email,
            about: "Hey, I'm using We Chat!",
            image: user.photoURL || '',
            createdAt: time,
            is_online: true,
            lastActive: time,
            role: `{{ Auth::user()->member }}`,
        };

        try {
            await setDoc(doc(usersCollection, user.uid), chatUser);
            console.log('User created in Firestore:', chatUser);
        } catch (error) {
            console.error('Error creating user in Firestore:', error);
        }
    }

    async function updateFirebaseToken() {
        if (auth.currentUser) {
            try {
                const token = await getToken(messaging, {vapidKey: 'BIKdl-B84phF636aS0ucw5k-KoGPnivJW4L_a9GNf7gyrWBZt--O9KcEzvsLl3h-3_Ld0rT8YFTsuupknvguW9s'});
                if (token) {
                    await setDoc(doc(database, 'users', auth.currentUser.uid), { push_token: token }, { merge: true });
                }
            } catch (error) {
                console.error('Error getting token or updating Firestore:', error);
            }
        }
    }

     function logout() {
        let uid = current_user.uid;
        try {
            signOut(auth);
            setOnline(uid, false);

            window.location.href = "{{ route('logoutProcess') }}";
        } catch (error) {
            console.error('Logout error:', error);
        }
    }

    window.addEventListener('beforeunload', (event) => {
        let uid = current_user.uid;
        try {
            signOut(auth);
            setOnline(uid, false);
        } catch (error) {
            console.error('Logout error:', error);
        }
    });

    const logoutButtons = ['btn-logout-header', 'btn-logout-header-mobile', 'btn-logout-header-3'];

    logoutButtons.forEach(buttonId => {
        const button = document.getElementById(buttonId);
        if (button) {
            button.addEventListener('click', (event) => {
                event.preventDefault();
                logout();
            });
        }
    });

    function setOnline(uid, isOnline) {
        try {
            updateDoc(doc(database, 'users', uid), {
                'is_online': isOnline,
                'last_active': Date.now(),
            }).then(() => {
                console.log('Status updated successfully', isOnline);
                // Assuming each user has a label identified by a unique ID like `status-${uid}`
            });
        } catch (error) {
            console.error('Error updating active status:', error);
        }
    }

    function getConsistentHashCode(s) {
        let hash = 0;
        for (let i = 0; i < s.length; i++) {
            let chr = s.charCodeAt(i);
            hash = ((hash << 5) - hash) + chr;
            hash |= 0;
        }
        return hash >>> 0;
    }

    function getConversationID(userUid) {
        let id = current_user.uid;

        let hash_value;

        if (getConsistentHashCode(id) <= getConsistentHashCode(userUid)) {
            hash_value = `${id}_${userUid}`;
        } else {
            hash_value = `${userUid}_${id}`;
        }
        return hash_value;
    }


    async function getAllChatRoomWithDoctor() {
        if (current_user) {
            const user = current_user;
            const doctorChatListQuery = query(
                collection(database, 'chats'),
                where('channelTypes', 'array-contains-any', [`${user.uid}_DOCTORS`, `${user.uid}_PHAMACISTS`, `${user.uid}_HOSPITALS`])
            );
            try {
                const querySnapshot = await getDocs(doctorChatListQuery);
                doctorChatList = [];
                querySnapshot.forEach((doc) => {
                    const res = doc.data();
                    const userIds = res.userIds;
                    userIds.forEach(userId => {
                        if (userId !== user.uid) {
                            doctorChatList.push(userId);
                        }
                    });
                });
                countUnreadMessages();
            } catch (error) {
                console.error("Error getting: ", error);
            }
            // const unsubscribe = onSnapshot(doctorChatListQuery, (querySnapshot) => {
            //     doctorChatList = [];
            //     querySnapshot.forEach((doc) => {
            //         const res = doc.data();
            //         const userIds = res.userIds;
            //         userIds.forEach(userId => {
            //             if (userId !== user.uid) {
            //                 doctorChatList.push(userId);
            //             }
            //         });
            //         countUnreadMessages();
            //     });
            // }, (error) => {
            //     console.error("Error getting: ", error);
            // });
        }
    }

    async function countUnreadMessages() {
        list_user_not_seen = [];
        for (let i = 0;i<doctorChatList.length;i++) {
            const roomRef = doc(chatsCollection, getConversationID(doctorChatList[i]));
            const messagesRef = collection(roomRef, "messages");
            const roomSnapshot = await getDoc(roomRef);
            if (roomSnapshot.exists()) {
                const roomData = roomSnapshot.data();
                const roomJson = roomData;
                const unreadUserId = roomJson.lastMessage?.fromId == doctorChatList[i] ? current_user.uid : doctorChatList[i];
                const unreadCount = await getDocs(query(messagesRef, where("readUsers." + unreadUserId, "==", false)))
                    .then((querySnapshot) => querySnapshot.docs);
                if(unreadCount.length>0){
                    unreadCount.forEach((docSnapshot) => {
                        const messageData = docSnapshot.data();
                        const senderId = messageData.fromId;
                        if (!list_user_not_seen.includes(senderId)) {
                            list_user_not_seen.push(senderId);
                        }
                    });
                }
                listenForMessages(messagesRef)
            } else {
                console.log("Không tìm thấy dữ liệu cho phòng chat.");
            }
        }
        $('.noti_number').html(list_user_not_seen.length>0?list_user_not_seen.length:'');
        $('.number_not_screen').html(list_user_not_seen.length>0?'('+list_user_not_seen.length+')':'');
        // const unsubscribeUser = onSnapshot(usersCollection, (querySnapshot) => {
        //     list_user = [];
        //     querySnapshot.forEach((doc) => {
        //         let res = doc.data();
        //         list_user.push(res);
        //     });
        //     renderUser();
        //     // getMessageFirebase();
        // }, (error) => {
        //     console.error("Error getting: ", error);
        // });
        try {
            const querySnapshot = await getDocs(usersCollection);
            list_user = [];
            querySnapshot.forEach((doc) => {
                list_user.push(doc.data());
            });
            renderUser();
        } catch (error) {
            console.error("Error getting data: ", error);
        }
    }

    let un_message = `<p class="unread">Not connected!</p>`;

    async function renderUser() {
        let html = ``;
        let html_online = ``;
        $('#friendslist-all-online #friends-all-online').html(html_online);
        $('#friendslist-connected #friends-connected').html(html);
        let doctorCount = 0;
        let promises = [];
        const searchTerm = $('#searchDoctor').val().toLowerCase(); // Normalize the search term

        $('.spinner-icon').css('display', 'block');
        // Helper function to render users
        localStorage.setItem('data_doctor',JSON.stringify(list_user));

        async function renderUsersBatch(startIndex, endIndex) {
            let batchPromises = [];
            for (let i = startIndex; i < endIndex && i < list_user.length; i++) {
                let res = list_user[i];
                let email = res.email;
                if ((res.role == 'DOCTORS' || res.role == 'PHAMACISTS' || res.role == 'HOSPITALS') && res.id != current_user.uid) {
                    batchPromises.push(getUserInfo(email).then((response) => {
                        const name_doctor = response.infoUser.name;
                        const hospital = response.infoUser.hospital ? response.infoUser.hospital : '';
                        const avt = response.infoUser.avt ? window.location.origin + response.infoUser.avt : '../../../../img/avt_default.jpg';
                        if ((searchTerm === " " || !searchTerm)) {
                            if (res.is_online) {
                                html_online += `<div class="friend user_connect" data-id="${res.id}" data-role="${res.role}" data-email="${email}" data-image="${avt}" data-online="${res.is_online}">
                                                    <img src="${avt}"/>
                                                    <p>
                                                        <strong class="max-1-line-title-widget-chat">${name_doctor}</strong>
                                                        <span>${hospital}</span>
                                                    </p>
                                                </div>`;
                            }
                        } else if (name_doctor.toLowerCase().includes(searchTerm.toLowerCase())) { // Filter by search term
                            if (doctorCount < 10) {
                                html_online += `<div class="friend user_connect" data-id="${res.id}" data-role="${res.role}" data-email="${email}" data-image="${avt}" data-online="${res.is_online}">
                                                    <img src="${avt}"/>
                                                    <p>
                                                        <strong class="max-1-line-title-widget-chat">${name_doctor}</strong>
                                                        <span>${hospital}</span>
                                                    </p>
                                                </div>`;
                                doctorCount++;
                            }
                        }
                    }).catch((error) => {
                        console.error(error);
                    }));
                }
                let redDotHtml = list_user_not_seen.includes(res.id) ? `<div class="${res.id}" style="position: absolute;right: 15px;top: 50%;transform: translateY(-50%);background-color: red;border-radius: 50%;width: 10px;height:10px"></div>` : '';
                if (doctorChatList.includes(res.id) && res.id !== current_user.uid) {
                    batchPromises.push(getUserInfo(email).then((response) => {
                        const name_doctor = response.infoUser.name;
                        const hospital = response.infoUser.hospital ? response.infoUser.hospital : '';
                        const avt = response.infoUser.avt ? window.location.origin + response.infoUser.avt : '../../../../img/avt_default.jpg';

                        html += `<div class="friend user_connect" data-id=${res.id} data-role="${res.role}" data-email="${email}" data-online="${res.is_online}">
                    <img src="${avt}"/>
                    <p>
                        <strong class="max-1-line-title-widget-chat">${name_doctor}</strong>
                        <span>${hospital}</span>
                    </p>
                    ${redDotHtml}
                </div>`;
                    }).catch((error) => {
                        console.error(error);
                    }));
                }
            }
            await Promise.all(batchPromises);
            $('#friendslist-all-online #friends-all-online').html(html_online);
            $('#friendslist-connected #friends-connected').html(html);
        }

        // Render the first 10 users immediately
        if (searchTerm) {
            await renderUsersBatch(0, list_user.length);
            if (doctorCount > 0) {
                $('#friendslist-all-online #friends-all-online').html(html_online);
            } else {
                $('#friendslist-all-online #friends-all-online').html(`<p><strong>Không có ai đang online</strong></p>`);
            }
        } else {
            // Render the first 10 users immediately
            await renderUsersBatch(0, 10);
            $('#friendslist-all-online #friends-all-online').html(html_online);

            // Render the remaining users in batches of 10
            for (let i = 10; i < list_user.length; i += 10) {
                await renderUsersBatch(i, i + 10);
                $('#friendslist-all-online #friends-all-online').html(html_online);
            }

            if (doctorCount && doctorCount == 0) {
                let html_not_user = `<p><strong>Không có ai đang online</strong></p>`;
                $('#friendslist-all-online #friends-all-online').html(html_not_user);
            }
        }

        if (doctorCount && doctorCount == 0) {
            let html_not_user = `<p><strong>Không có ai đang online</strong></p>`;
            $('#friendslist-all-online #friends-all-online').html(html_not_user);
        }

        $('.spinner-icon').css('display', 'none');
        $('#chat_doctor').attr('disabled',false)
        getMessageFirebase();
    }

    // Event listener for the search input
    let debounceTimeout = null;

    $('#searchDoctor').on('input', function() {
        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(function() {
            renderUser();
        }, 500);
    });

    function getUserInfo(email) {
        let url = "{{ route('info.user.email', ['email' => 'EMAIL']) }}";
        url = url.replace('EMAIL', email);
        let accessToken = `Bearer ` + token;
        let headers = {
            "Authorization": accessToken
        };
        return new Promise((resolve, reject) => {
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                headers: headers,
                success: function (response) {
                    resolve(response);
                },
                error: function (xhr, status, error) {
                    reject(error);
                }
            });
        });
    }

    function listenForMessages(messagesRef) {
        const q = query(messagesRef, where('toId', '==', current_user.uid));
        onSnapshot(q, snapshot => {
            snapshot.docChanges().forEach(change => {
                if (change.type === "added") {
                    const message = change.doc.data();
                    if (message.toId == current_user.uid && !message.readUsers[current_user.uid]){
                        playNotificationSound();
                    }

                }
            });
        }, error => {
            console.error("Error listening for messages: ", error);
        });
    }

    var notificationSound = new Audio('agora-video/message-ringtone.mp3');

    function playNotificationSound() {
        notificationSound.play().catch(error => {
            console.error('Error playing notification sound:', error);
        });
    }

    function renderMessage(list_message, html) {
        $('#chat-messages').html('');
        if (list_message.length > 0) {
            let messageIndex = 0;
            renderNextMessage();
            function renderNextMessage() {
                if (messageIndex >= list_message.length) {
                    let chatMessages = document.getElementById('chat-messages');
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                    return;
                }

                let message = list_message[messageIndex];
                let time = formatDate(message.sent);

                if (message.type == 'prescription') {

                    // Search cart
                    let url = "{{ route('api.backend.cart.search', ['prescription_id' => 'REPLACE_ID']) }}";
                    url = url.replace('REPLACE_ID', message.msg);
                    let accessToken = `Bearer ` + token;
                    let headers = {
                        "Authorization": accessToken
                    };
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        headers: headers,
                        success: function (response) {
                            if (response.error == 0 && response.data) {
                                html = `<a><div class="mb-3 box-order-chat">`;
                                response.data.forEach(item => {
                                    html += `<div class="content-order-item mb-2">
                                    <div class="d-flex ">
                                        <p class="title-name">Tên thuốc: </p>
                                        <p class="content-order-chat">${item.product_medicine.name}</p>
                                    </div>
                                    <div class="d-flex ">
                                        <p class="title-name">Số lượng: </p>
                                        <p class="content-order-chat">${item.quantity}</p>
                                    </div>
                                    <div class="d-flex ">
                                        <p class="title-name">Sử dụng: </p>
                                        <p class="content-order-chat">${item.note}</p>
                                    </div>
                                    <div class="d-flex ">
                                        <p class="title-name">Số ngày sử dụng: </p>
                                        <p class="content-order-chat">${item.treatment_days}</p>
                                    </div>
                                </div>`;
                                });

                                if (response.data[0].status == 'COMPLETE') {
                                    html += `<div class="d-flex justify-content-end">
                                    <a class="ml-2" type="button" href="{{ route('user.checkout.reorder', ['prescription_id' => '']) }}${response.data[0].prescription_id}">
                                        <button class="btn btn-2 btn-sep icon-cart">Mua lại</button>
                                    </a>
                                </div>`;
                                } else {
                                    html += `<div class="d-flex justify-content-end">
                                    <a href="{{route('user.checkout.index', ['prescription_id' => '']) }}${response.data[0].prescription_id}" class="btn btn-2 btn-sep icon-cart addToCartButton">Mua thuốc</a>
                                </div>`;
                                }

                                html += `</div></a>`;

                                $('#chat-messages').append(html);
                            }
                            messageIndex++;
                            renderNextMessage();
                        },
                        error: function (xhr, status, error) {
                            console.error(error);
                            messageIndex++;
                            renderNextMessage();
                        }
                    });
                }else if (message.type == 'file'){
                    if (message.fromId === current_user.uid) {
                        html = `<div class="message right">
                        <div class="msg-info">
                        </div>
                        <div class="bubble">
                            <a href="${message.fileUrl}" style="color: white" target="_blank"><i class="fa-solid fa-paperclip mr-1"></i> ${message.fileName}</a>
                            <div class="corner"></div>
                        </div>
                    </div>`;
                    } else {
                        html = `<div class="message">
                        <div class="msg-info">
                        </div>
                        <div class="bubble">
                            <a href="${message.fileUrl}" target="_blank"> <i class="fa-solid fa-paperclip mr-1"></i> ${message.fileName}</a>
                            <div class="corner"></div>
                        </div>
                    </div>`;
                    }
                    $('#chat-messages').append(html);

                    messageIndex++;
                    renderNextMessage();
                }
                else if (message.type == 'image'){
                    if (message.fromId === current_user.uid) {
                        html = `<div class="message right" style="max-height: 200px; height: inherit">
                        <div class="msg-info">
                        </div>
                        <div class="bubble" style="background-color: white">
                            <img src="${message.fileUrl}" class="image-sent" alt="${message.fileName}"/>
                            <div class="corner"></div>
                        </div>
                    </div>`;
                    } else {
                        html = `<div class="message">
                        <div class="msg-info">
                        </div>
                        <div class="bubble" style="background-color: white">
                            <img src="${message.fileUrl}" class="image-sent" alt="${message.fileName}"/>
                            <div class="corner"></div>
                        </div>
                    </div>`;
                    }
                    $('#chat-messages').append(html);

                    messageIndex++;
                    renderNextMessage();
                }
                else {
                    if (message.fromId === current_user.uid) {
                        html = `<div class="message right">
                        <div class="msg-info">
                        </div>
                        <div class="bubble">
                            ${message.msg}
                            <div class="corner"></div>
                        </div>
                    </div>`;
                    } else {
                        html = `<div class="message">
                        <div class="msg-info">
                        </div>
                        <div class="bubble">
                            ${message.msg}
                            <div class="corner"></div>
                        </div>
                    </div>`;
                    }
                    $('#chat-messages').append(html);

                    messageIndex++;
                    renderNextMessage();
                }
            }


        }
    }

    // Assuming Firebase has been initialized and all necessary SDKs have been included
    $(document).ready(function() {
        $('.file-send-btn').click(function() {
            $('#file-input').click();
        });
        // File input change handler
        $('#file-input').change(function(e) {
            var file = e.target.files[0];

            if (!file) {
                return;
            }

            var fileName = file.name;
            var fileType = file.type;

            // Display file name in input box
            $('#msger-input').val(fileName);

            if (fileType.startsWith('image/')) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(file);
            } else {
                $('#image-preview').hide();
            }
        });

        // Send button click handler
        $('.msger-send-btn').click(function () {
            let file = $('#file-input')[0].files[0];
            let toUser = $(this).data('to_user');
            let to_email = $(this).data('to_email');

            if (file) {
                // Determine file extension
                let ext = file.name.split('.').pop();
                sendMessage(toUser, to_email, file, file.type.startsWith('image/') ? 'image' : 'file', ext);
            } else {
                let msg = $('#msger-input').val();
                sendMessage(toUser, to_email, msg, 'text');
            }

            $('#msger-input').val('');
            $('#file-input').val('');
            $('#image-preview').hide();
        });

        async function sendMessage(chatUserID, to_email, content, type, ext = null) {
            const time = Date.now().toString();
            const receiverId = chatUserID;
            const message = {
                toId: receiverId,
                read: '',
                type: type,
                fromId: current_user.uid,
                readUsers: {[current_user.uid]: true, [receiverId]: false},
                sent: time
            };

            if (type === 'text' || type === 'prescription') {
                message.msg = content;
            } else {
                message.fileUrl = await uploadFile(content, ext, chatUserID);
                message.fileName = content.name;
                message.msg = message.fileUrl;
            }

            let conversationID = getConversationID(chatUserID);
            const ref = collection(database, `chats/${conversationID}/messages/`);

            try {
                await setDoc(doc(ref, time), message);
                await saveMessage(`{{ Auth::user()->email }}`, to_email, message);
                await pushNotification(to_email, type === 'text' ? content : content.name);
                await updateLastMessage(chatUserID, message);
                console.log('Message sent successfully');
            } catch (error) {
                console.error('Error sending message:', error);
            }
        }

        async function uploadFile(file, ext, chatUserID) {
            // Create a reference for the new file at Firebase Storage
            const storageRef = ref(storage, `images/${getConversationID(chatUserID)}/${Date.now()}.${ext}`);

            try {
                // Upload the file to the specified reference
                const snapshot = await uploadBytes(storageRef, file);

                // After upload, retrieve the download URL
                return await getDownloadURL(snapshot.ref);
            } catch (error) {
                console.error('Failed to upload file:', error);
                return null; // Handle the error appropriately
            }
        }
//         async function uploadFile(file, ext, chatUserID) {
//             const storageRef = ref(storage, `images/${getConversationID(chatUserID)}/${Date.now()}.${ext}`);
// console.log(storageRef);
//             try {
//                 const snapshot = await storageRef.put(file);
//                 return await snapshot.ref.getDownloadURL();
//             } catch (error) {
//                 console.error('Failed to upload file:', error);
//                 return null; // Handle null in sending logic
//             }
//         }
    });


    function renderLayOutChat(email, id) {
        let btn_message = $('.msger-send-btn');
        btn_message.data('to_user', id);
        btn_message.data('to_email', email);
        $('#msger-input').val('');
    }

    function getMessageFirebase() {
        let conversationID = 0;
        let id = 0;
        $('.user_connect').click(function () {
            id = $(this).data('id');
            let email = $(this).data('email');
            let role = $(this).data('role');
            let img = $(this).data('image')
            let is_online = $(this).data('online')

            isShowOpenWidget = true;

            chatUserId = $(this).data('id');
            emailUser = $(this).data('email');

            removeSpanBadges(this);

            var childOffset = $(this).offset();
            var parentOffset = $(this).parent().parent().offset();
            var childTop = childOffset.top - parentOffset.top;
            var clone = $(this).find('img').eq(0).clone();
            var top = childTop + 12 + "px";


            setTimeout(function () {
                $("#profile p").addClass("animate");
                $("#profile").addClass("animate");
            }, 10);
            setTimeout(function () {
                $("#chat-messages").addClass("animate");
            }, 10);

            var name = $(this).find("p strong").html();
            $("#profile p").html(name);
            $("#profile span").html(email);
            $("#chatview-image").attr('src', img);

            const onlineDot = document.querySelector(`#online-div`);
            const offlineDot = document.querySelector(`#offline-div`);

            if (is_online) {
                onlineDot.style.display = 'block';   // Show online dot
                offlineDot.style.display = 'none';  // Hide offline dot
            } else {
                onlineDot.style.display = 'none';    // Hide online dot
                offlineDot.style.display = 'block';  // Show offline dot
            }

            $(".message").not(".right").find("img").attr("src", $(clone).attr("src"));
            let parent = $(this).parent();
            parent.hide();
            $('#chat-widget-navbar').hide();
            $('#myTabContent').hide();
            $('#chatview').show();

            $('#close').unbind("click").click(function () {
                isShowOpenWidget = false;

                $("#chat-messages, #profile, #profile p").removeClass("animate");

                setTimeout(function () {
                    $('#chatview').hide();
                    parent.show();
                    $('#myTabContent').show();
                    $('#chat-widget-navbar').show();
                }, 10);
            });

            conversationID = getConversationID(id);

            const messagesCollectionRef = collection(database, `chats/${conversationID}/messages`);

            let html = ``;
            let timeout;
            let lastSnapshot = [];
            const unsubscribe = onSnapshot(messagesCollectionRef, (querySnapshot) => {
                let list_message = [];
                $('#chat-messages').html('');

                querySnapshot.forEach((doc) => {
                    list_message.push(doc.data());
                });

                function scheduleRender(list_message, html) {
                    if (timeout) {
                        clearTimeout(timeout);
                    }

                    timeout = setTimeout(() => {
                        if (JSON.stringify(list_message) !== JSON.stringify(lastSnapshot)) {
                            renderMessage(list_message, html);
                            lastSnapshot = list_message;
                        }
                    }, 2000);
                }

                scheduleRender(list_message, html);

            }, (error) => {
                console.error("Error getting: ", error);
            });

            renderLayOutChat(email, id);

            let user = {
                role: role,
                id: id
            };

            initialChatRoom(user);
        });

        $('.friend').click(function () {
            markAllMessagesAsRead(id, conversationID);
        });
    }

    async function markAllMessagesAsRead(userId, conversationId) {
        try {
            const roomRef = doc(chatsCollection, conversationId);
            await updateDoc(roomRef, {
                [`unreadMessageCount.${current_user.uid}`]: 0
            });

            const messagesCollectionRef = collection(roomRef, 'messages');
            const querySnapshot = await getDocs(query(messagesCollectionRef, where(`readUsers.${current_user.uid}`, '==', false)));

            querySnapshot.forEach(async (doc) => {
                try {
                    const messageRef = doc.ref;
                    await setDoc(messageRef, {
                        readUsers: {
                            [current_user.uid]: true
                        }
                    }, { merge: true });
                    await updateUnreadMessageCount(userId,conversationId);
                } catch (error) {
                    console.error("Error marking message as read: ", error);
                }
            });
        } catch (error) {
            console.error("Error marking messages as read: ", error);
        }
    }

    async function updateUnreadMessageCount(userId,conversationId) {
        try {
            $('.' + userId).hide();
            const roomRef = doc(chatsCollection, conversationId);
            await updateDoc(roomRef, {
                [`unreadMessageCount.${current_user.uid}`]: 0
            });
            const messagesCollectionRef = collection(roomRef, 'messages');
            const querySnapshot = await getDocs(query(messagesCollectionRef, where(`readUsers.${current_user.uid}`, '==', false)));
            const unreadCount = querySnapshot.size;

            $('.noti_number').html(unreadCount > 0 ? unreadCount : '');
            $('.number_not_screen').html(unreadCount > 0 ? '(' + unreadCount + ')' : '');
        } catch (error) {
            console.error("Error updating unread message count: ", error);
        }
    }

    async function initialChatRoom(user) {
        const currentChatRoom = await getChatGroup(user);
        const targetChannelType = user.role;
        let myChannelType;

        if (current_role !== '{{ \App\Enums\Role::PHAMACISTS }}' &&
            current_role !== '{{ \App\Enums\Role::DOCTORS }}' &&
            current_role !== '{{ \App\Enums\Role::CLINICS }}' &&
            current_role !== '{{ \App\Enums\Role::HOSPITALS }}') {
            myChannelType = user.role;
        } else {
            myChannelType = current_role;
        }
        console.log(current_user);
        if (currentChatRoom === null) {
            const chatRoomInfo = {
                userIds: [current_user.uid, user.id],
                groupId: getConversationID(user.id),
                createdBy: current_user.uid,
                unreadMessageCount: {[current_user.uid]: 0, [user.id]: 0},
                createdAt: new Date().getTime().toString(),
                channelTypes: [
                    `${current_user.uid}_${myChannelType}`,
                    `${user.id}_${myChannelType}`
                ]
            };
            await createChatRoom(user, chatRoomInfo);
        }
    }

    async function createChatRoom(chatUser, chatRoom) {
        try {
            const chatMessageCollection = collection(database, 'chats');
            const chatDocRef = doc(chatMessageCollection, getConversationID(chatUser.id));
            await setDoc(chatDocRef, chatRoom, {merge: true});
            console.log("Chat room created successfully.");
        } catch (error) {
            console.error("Error creating chat room:", error);
        }
    }

    async function getChatGroup(chatUser) {
        try {
            const chatMessageCollection = collection(database, 'chats');
            const chatDocSnapshot = await doc(chatMessageCollection, getConversationID(chatUser.id));

            if (chatDocSnapshot.exists) {
                const data = chatDocSnapshot.data();
                console.log("Chat group data:", data);
                return data;
            } else {
                console.log("Chat group does not exist.");
                return null;
            }
        } catch (error) {
            console.error("Error getting chat group:", error);
            return null;
        }
    }

    async function updateLastMessage(chatUserID, lastMessage) {
        const callType = _getTypeFromString(lastMessage.msg);
        let updatedMessage = JSON.parse(JSON.stringify(lastMessage));

        if (callType !== "") {
            updatedMessage.msg = callType;
        }

        try {
            const chatMessageCollection = collection(database, 'chats');
            const chatDocRef = doc(chatMessageCollection, getConversationID(chatUserID));
            if (updatedMessage && updatedMessage.msg) {
                await setDoc(chatDocRef, {lastMessage: updatedMessage}, {merge: true});
                console.log("Chat set successfully.");
            } else {
                throw new Error("Invalid or missing updated message data.");
            }
        } catch (error) {
            console.error("Error set chat:", error);
        }

        // await countUnreadMessages(chatUserID, updatedMessage);
    }

    function _getTypeFromString(name) {
        return name;
    }

    async function pushNotification(to_email, msg) {
        const notification = {
            "title": `{{ Auth::user()->username }}`,
            "body": msg,
            "android_channel_id": "chats"
        };

        const data = {
            email: to_email,
            data: notification,
            notification: notification
        };

        let sendNotiUrl = `{{ route('restapi.mobile.fcm.send') }}`
        await $.ajax({
            url: sendNotiUrl,
            method: 'POST',
            data: data,
            success: function (response) {
                console.log(response)
            },
            error: function (error) {
                console.log(error.responseJSON.message);
            }
        });
    }

    async function saveMessage(from_email, to_email, message) {
        let saveMessageUrl = `{{ route('api.backend.messages.save') }}`

        const data = {
            from_user_email: from_email,
            to_user_email: to_email,
            content: message.msg
        };

        const headers = {
            'Authorization': `Bearer ${token}`
        };

        await $.ajax({
            url: saveMessageUrl,
            method: 'POST',
            data: data,
            headers: headers,
            success: function (response) {
                console.log(response)
            },
            error: function (error) {
                console.log(error);
            }
        });
    }


    function handleSeenMessage() {
        if (!chatUserId) {
            return;
        }

        let url = `{{ route('api.backend.connect.chat.seen-message', ['id' => ':id']) }}`;
        url = url.replace(':id', chatUserId);


        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",

            success: function (data) {
            },
            error: function (e) {
                console.log(e);
            }
        });

    }

    function calculateTotalMessageUnseen(e) {

        if (isShowOpenWidget) {
            return;
        }

        totalMessageUnseen++;

        $('#totalMsgUnseen').html(totalMessageUnseen);

        // duyệt class friend, tìm ra div có data-id = e.message.from
        // tăng thêm 1 span.badge
        $("#friendslist-connected .friend").each(function () {

            if ($(this).data('id') === e.message.from) {
                let countUnseen = $(this).data('msg-unseen');
                countUnseen++;
                $(this).data('msg-unseen', countUnseen);

                $(this).find('span.badge-light').html(countUnseen);
            }

        });
    }


    function renderMessageReceive(element) {
        let html = '';
        element = element.message;

        if (element.type != null) {
            if (!element.text) {
                return;
            }

            if (element.type == 'DonThuocMoi') {
                let url = `{{ route('view.prescription.result.detail', ['id' => ':id']) }}`;
                url = url.replace(':id', element.uuid_session);

                html = `<div class="mb-3 d-flex justify-content-center">
                        <a href="${url}">
                        <button class="btn btn-1 btn-sep icon-info">Xem đơn thuốc</button>
                        </a>
                        <a class="ml-2" onclick="addToCart_WidgetChat(${element.uuid_session})">
                        <button class="btn btn-2 btn-sep icon-cart">Mua thuốc</button>
                        </a>
                        </div>`


            }

            if (element.type.indexOf("-") !== -1 &&  element.type.split("-")[0] == 'EndCall') {
                let callUrl = "{{ route('agora.call') }}";
                if (element.from != currentUserIdChat) {
                    callUrl += "?user_id_1=" + currentUserIdChat + "&user_id_2=" + element.from
                }else{
                    callUrl += "?user_id_1=" + currentUserIdChat + "&user_id_2=" + element.to
                }

                let callingMinutes = element.type.split("-")[1];
                // Convert calling minutes to time format (hours:minutes)
                var hours = Math.floor(callingMinutes / 60);
                var minutes = callingMinutes % 60;

                // Format the time as a string
                var timeFormat = hours + ":" + (minutes < 10 ? "0" : "") + minutes;

                let isMySeen = element.from === currentUserIdChat ? 'right' : '';

                html = `<div class="message ${isMySeen}">
                        <img src="${element.from_contact.avt}"/>
                        <div class="bubble mb-3">
                            Cuộc gọi đi - ${timeFormat}
                            <hr class="my-2">
                            <a href="${callUrl}" onclick="recallUser(event)">Gọi lại</a>
                            <div class="corner"></div>
                        </div>
                    </div>`;
            }

        } else {
            html = `<div class="message">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/1_copy.jpg"/>
                        <div class="bubble">
                            ${element.text}
                            <div class="corner"></div>
                        </div>
                    </div>`
        }

        $('#chat-messages').append(html);
        autoScrollChatBox();
    }


    function handleCloseButton(uuid_session) {
        let currentUserId = '{{ Auth::check() ? Auth::user()->id : '' }}';

        $.ajax({
            url: "{{ route('chat.send-message.renew-uuid') }}",
            type: "POST",
            dataType: "json",
            data: {
                sender_id: currentUserId,
                receiver_id: chatUserId,
                text: '',
                uuid_session: uuid_session,
                type: uuid_session
            },
            success: function (data) {
                uuid_session = data.uuid_session;
            },
            error: function (e) {
                console.log(e);
            }
        });
    }

    function removeSpanBadges(divElement) {
        $(divElement).find('span.badge').html('');

        let countUnseen = $(divElement).data('msg-unseen');

        totalMessageUnseen -= countUnseen;

        if (totalMessageUnseen <= 0) {
            $('#totalMsgUnseen').html('');
        } else {
            $('#totalMsgUnseen').html(totalMessageUnseen);
        }
    }

    // Gắn sự kiện keyup cho input
    $('#text-chatMessage').keypress(function (event) {
        // Kiểm tra xem nút nhấn có phải là Enter (mã 13) hay không
        if (event.keyCode === 13) {
            // Xử lý sự kiện khi nhấn Enter
            sendMessageChatWidget();
        }
    });

    function sendMessageChatWidget() {
        let textChat = $('#text-chatMessage').val();
        if (textChat.trim() == '') {
            return;
        }

        let currentUserId = '{{ Auth::check() ? Auth::user()->id : '' }}';

        $.ajax({
            url: "{{ route('chat.send-message') }}",
            type: "POST",
            dataType: "json",
            data: {
                sender_id: currentUserId,
                receiver_id: chatUserId,
                text: textChat,
                uuid_session: uuid_session
            },
            success: function (data) {
                uuid_session = data.uuid_session;

                renderMessageFromThisUser(textChat);
                afterSendMessageChatWidget();
            },
            error: function (e) {
                console.log(e);
            }
        });
    }

    function renderMessageFromThisUser(textChat) {
        let html = `<div class="message right">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/1_copy.jpg"/>
                        <div class="bubble">
                            ${textChat}
                            <div class="corner"></div>
                        </div>
                    </div>`
        $('#chat-messages').append(html);
    }

    function afterSendMessageChatWidget() {
        $('#text-chatMessage').val('');

        //scroll to bottom
        autoScrollChatBox();
    }

    function autoScrollChatBox() {
        $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);
    }


    $(function () {

        $("#chat-circle").click(function () {
            $("#chat-circle").toggle("scale");
            $(".chat-box").toggle("scale");
        });

        $(".chat-box-toggle").click(function () {
            isShowOpenWidget = false;
            $("#chat-circle").toggle("scale");
            $(".chat-box").toggle("scale");
        });

    });

    $(document).ready(function () {


        var preloadbg = document.createElement("img");
        preloadbg.src = "https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/timeline1.png";

        $("#sendmessage input").focus(function () {
            if ($(this).val() == "Send message...") {
                $(this).val("");
            }
        });
        $("#sendmessage input").focusout(function () {
            if ($(this).val() == "") {
                $(this).val("Send message...");

            }
        });

    });

    function handleStartChat(id) {
        getMessage(id);
    }

    async function getMessage(id) {
        document.getElementById('chat-messages').innerHTML = '';

        let accessToken = `Bearer ` + token;

        let url = `{{ route('api.backend.connect.chat.getMessageByUserId', ['id' => ':id']) }}`;
        url = url.replace(':id', id);
        let data = [];

        let result = await fetch(url, {
            method: 'GET',
            headers: {
                'Authorization': accessToken
            },
        });

        if (result.ok) {
            data = await result.json();
            renderMessage(data);
        }
    }

    function recallUser(event) {
        event.preventDefault();

        let callUrl = event.target.href;

        let form = $('<form>')
            .attr('method', 'post')
            .attr('action', callUrl)
            .attr('target', '_blank');

        let csrfToken = `{{ csrf_token() }}`;
        let csrfInput = $('<input>')
            .attr('type', 'hidden')
            .attr('name', '_token')
            .val(csrfToken);

        form.append(csrfInput);

        $('body').append(form);
        form.submit();
    }

    function addToCart_WidgetChat(id) {
        loadingMasterPage();
        let data = {
            prescription_id: id,
            user_id: `{{ Auth::user()->id }}`,
        };
        let accessToken = `Bearer ` + token;
        let headers = {
            "Authorization": accessToken
        };

        try {
            $.ajax({
                url: `{{ route('api.backend.prescription.result.add.cart.v2') }}`,
                method: 'POST',
                headers: headers,
                data: data,

                success: function (response, textStatus, xhr) {
                    loadingMasterPage();
                    alert(response.message);
                    var statusCode = xhr.status;
                    if (statusCode === 200) {
                        window.location.href = `{{ route('user.checkout.index') }}`;
                    }
                },
                error: function (xhr, status, error) {
                    loadingMasterPage();
                    alert(xhr.responseJSON.message);
                }
            });
        } catch (e) {
        }
    }


    function renderTotalMessageUnseen(data) {
        if (data.length < 1) {
            return;
        }
        totalMessageUnseen = data[0]['total_unread_message'];

        if (totalMessageUnseen <= 1) {
            totalMessageUnseen = '';
        }
        $('#chat-circle').append(
            `<span class="badge badge-light text-black" id="totalMsgUnseen">${totalMessageUnseen}</span>`);
    }

    // getListUserWasConnect();

    function handleStartChatWithDoctor(id = 0) {
        /* tất cả các hàm dưới đây đều ở trong file chat-message.blade.php
         * id nhận vào là id của người dùng cần chat
         * hàm hideTabActive() dùng để ẩn tất cả các tab đang active
         * hàm getMessage(id) dùng để lấy tin nhắn của người dùng đó với người dùng hiện tại
         * hàm loadDisplayMessage(id) dùng để load tin nhắn của người dùng đó với người dùng hiện tại
         * hàm showOrHiddenChat() dùng để hiển thị widget chat
         */

        hideTabActive();
        getMessage(id);
        loadDisplayMessage(id);
        showOrHiddenChat();
    }

    function hideTabActive() {
        let tabActive = document.querySelectorAll('.tab-pane.fade');
        tabActive.forEach(function (tab) {
            tab.classList.remove('active');
            tab.classList.remove('show');
        });
    }

    function showOrHiddenChat() {
        document.getElementById('chat-circle').click();
    }

    let html_widgetChat = `<div class="service-result-item d-flex align-items-center justify-content-between border p-3">
                    <div class="prescription-group">
                        <div class="row w-75">
                            <div class="form-group">
                                <label for="medicine_name">Medicine Name</label>
                                <input type="text" class="form-control medicine_name input_medicine_name" value=""
                                    name="medicine_name"  data-toggle="modal" data-target="#modal-add-medicine-widget-chat" readonly>
                                <input type="text" hidden class="form-control medicine_id_hidden" name="medicine_id_hidden" value="">

                            </div>
                            <div class="form-group">
                                <label for="medicine_ingredients">Medicine Ingredients</label>
                                <textarea class="form-control medicine_ingredients" readonly name="medicine_ingredients" rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="quantity">{{ __('home.Quantity') }}</label>
                                <input type="number" min="1" class="form-control quantity" name="quantity">
                            </div>
                            <div class="form-group">
                                <label for="detail_value">Note</label>
                                <input type="text" class="form-control detail_value" name="detail_value">
                            </div>
                            <div class="form-group">
                                <label for="treatment_days">Số ngày điều trị</label>
                                <input type="number" min="1" class="form-control treatment_days" name="treatment_days" value="1">
                            </div>
                        </div>
                        <div class="action mt-3">
                            <i class="fa-regular fa-trash-can loadTrash_widgetChat" style="cursor: pointer; font-size: 24px"></i>
                        </div>
                    </div>
                </div>`;


    $('.btn-add-medicine').click(function () {
        $('#list-service-result').append(html_widgetChat);
        loadData_widgetChat();
        loadListMedicine();
    });

    function loadDisplayMessage(id) {
        var friendDivs = document.querySelectorAll('.user_connect');

        friendDivs.forEach(function (div) {
            // Lấy giá trị data-id của từng div
            var dataId = div.getAttribute('data-id');

            // Kiểm tra xem data-id có bằng currentId hay không
            if (dataId === id) {
                div.click();
            }
        });
    }


    function loadListMedicine() {
        let inputNameMedicine_Search = $('#inputSearchNameMedicine').val().toLowerCase();
        let inputDrugIngredient_Search = $('#inputSearchDrugIngredient').val().toLowerCase();
        let object_search = $('#object_search').val().toLowerCase();

        let url = '{{ route('view.prescription.result.get-medicine') }}'
        url = url +
            `?name_search=${inputNameMedicine_Search}&drug_ingredient_search=${inputDrugIngredient_Search}&object_search=${object_search}`;

        $.ajax({
            url: url,
            method: 'GET',
            success: function (response) {
                renderMedicine(response);
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function renderMedicine(data) {
        let html = '';
        data.forEach((medicine) => {
            let url = '{{ route('medicine.detail', ':id') }}';
            url = url.replace(':id', medicine.id);

            html += `<div class="col-sm-6 col-xl-4 mb-3 col-6 find-my-medicine-2">
                                <div class="m-md-2 ">
                                    <div class="frame component-medicine w-100">
                                        <div class="img-pro justify-content-center d-flex img_product--homeNew w-100">
                                            <img loading="lazy" class="rectangle border-img w-100"
                                                 src="${medicine.thumbnail}"/>
                                        </div>
                                        <div class="div">
                                            <div class="div-2">
                                                <a target="_blank" class="w-100"
                                                   href="${url}">
                                                    <div
                                                        class="text-wrapper text-nowrap overflow-hidden text-ellipsis w-100">${medicine.name}</div>
                                                </a>
                                                <div
                                                    class="text-wrapper-3">${medicine.price} ${medicine.unit_price ?? 'VND'}</div>
                                                <div
                                                    class="text-wrapper-3">Còn lại: ${medicine.quantity}</div>
                                            </div>
                                            <div class="div-wrapper">
                                                <a style="cursor: pointer" class="handleSelectInputMedicine_widgetChat" data-id="${medicine.id}" data-name="${medicine.name}" data-quantity="${medicine.quantity}"
                                                   data-dismiss="modal">
                                                    <div class="text-wrapper-4">{{ __('home.Choose...') }}</div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`
        });

        $('#modal-list-medicine-widget-chat').html(html);

        $('.handleSelectInputMedicine_widgetChat').click(function () {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let quantity = $(this).data('quantity');
            elementInputMedicine_widgetChat.val(name);
            next_elementInputMedicine_widgetChat.val(id);
            next_elementQuantity_widgetChat.off('change');

            next_elementQuantity_widgetChat.attr('max', quantity);

            // Thêm sự kiện onchange
            next_elementQuantity_widgetChat.on('change', function () {
                // Lấy giá trị hiện tại của next_elementQuantity_widgetChat
                var currentValue = next_elementQuantity_widgetChat.val();

                // Chuyển đổi giá trị thành số để so sánh
                currentValue = parseInt(currentValue);

                // Kiểm tra nếu giá trị lớn hơn quantity
                if (currentValue > quantity) {
                    // Hiển thị cảnh báo
                    alert('Giá trị không thể lớn hơn ' + quantity);
                    // Cài đặt lại giá trị về quantity
                    next_elementQuantity_widgetChat.val(quantity);
                }
            });

            getIngredientsByMedicineId(id)
                .then(result => {
                    console.log(result.component_name); // Log kết quả
                    next_elementMedicineIngredients_widgetChat.val(result.component_name); // Sử dụng kết quả
                })
                .catch(error => {
                    console.error('Đã xảy ra lỗi:', error);
                });
        });

        $('.input_medicine_name').click(function () {
            elementInputMedicine_widgetChat = $(this);
            next_elementInputMedicine_widgetChat = $(this).next('.medicine_id_hidden');
            next_elementQuantity_widgetChat = $(this).parents().parents().find('input.quantity');
            next_elementMedicineIngredients_widgetChat = $(this).parents().parents().find(
                'textarea.medicine_ingredients');
        });

        $('.loadTrash_widgetChat').click(function () {
            $(this).parent().parent().remove();
        });

    }


    $('.createPrescription_widgetChat').click(function () {

            let form = document.getElementById('prescriptionForm');
            let formData = new FormData(form);

            let my_array = [];

            // Lấy phần tử cha (div#prescriptionForm)
            var prescriptionForm = document.getElementById('prescriptionForm');

            // Lấy các phần tử con có class 'medicine_name'
            var medicine_name = prescriptionForm.getElementsByClassName('medicine_name');

            // Lấy các phần tử con có class 'medicine_ingredients'
            var medicine_ingredients = prescriptionForm.getElementsByClassName('medicine_ingredients');

            // Lấy các phần tử con có class 'quantity'
            var quantity = prescriptionForm.getElementsByClassName('quantity');

            // Lấy các phần tử con có class 'detail_value'
            var detail = prescriptionForm.getElementsByClassName('detail_value');

            // Lấy các phần tử con có class 'treatment_days'
            var treatment = prescriptionForm.getElementsByClassName('treatment_days');

            // Lấy các phần tử con có class 'medicine_id_hidden'
            var medicine_id_hidden = prescriptionForm.getElementsByClassName('medicine_id_hidden');

            for (let j = 0; j < medicine_name.length; j++) {
                let name = medicine_name[j].value;
                let ingredients = medicine_ingredients[j].value;
                let quantity_value = quantity[j].value;
                let detail_value = detail[j].value;
                let treatment_value = treatment[j].value;

                let medicine_id_hidden_value = '';
                if (medicine_id_hidden[j]) {
                    medicine_id_hidden_value = medicine_id_hidden[j].value;
                }

                if (!name && !ingredients && !quantity_value) {
                    alert('Please enter medicine name or medicine ingredients or quantity!')
                    return;
                }

                let item = {
                    medicine_name: name,
                    medicine_ingredients: ingredients,
                    quantity: quantity_value,
                    note: detail_value ?? '',
                    medicine_id: medicine_id_hidden_value ?? '',
                    treatment_days: treatment_value,
                }
                item = JSON.stringify(item);
                my_array.push(item);
            }

            const itemList = [
                'prescriptions',
            ];

            itemList.forEach(item => {
                formData.append(item, my_array.toString());
            });

            formData.append('chatUserId', chatUserId);
            formData.append('email', emailUser);

            //ADD PRODUCTS TO CART HANDLE
            var products = [];
            $('.prescription-group').each(function () {
                var group = $(this);
                var medicine_id = group.find('.medicine_id_hidden').val();
                var quantity = group.find('.quantity').val();
                var note = group.find('.detail_value').val();
                var treatmentDays = group.find('.treatment_days').val();

                var product = {
                    id: medicine_id,
                    quantity: parseInt(quantity),
                    note: note || null,
                    treatment_days: parseInt(treatmentDays)
                };

                products.push(product);
            });
            formData.append('products', JSON.stringify(products));

            let accessToken = `Bearer ` + token;
            let headers = {
                'Authorization': accessToken,
            };

            async function sendMessage(chatUserID, to_email, content, type, ext = null) {
                const time = Date.now().toString();
                const receiverId = chatUserID;
                const message = {
                    toId: receiverId,
                    read: '',
                    type: type,
                    fromId: current_user.uid,
                    readUsers: {[current_user.uid]: true, [receiverId]: false},
                    sent: time
                };

                if (type === 'text' || type === 'prescription') {
                    message.msg = content;
                } else {
                    message.fileUrl = await uploadFile(content, ext, chatUserID);
                    message.fileName = content.name;
                }

                let conversationID = getConversationID(chatUserID);
                const ref = collection(database, `chats/${conversationID}/messages/`);

                try {
                    await setDoc(doc(ref, time), message);
                    await pushNotification(to_email, type === 'text' ? content : content.name);
                    await updateLastMessage(chatUserID, message);
                    await saveMessage(`{{ Auth::user()->email }}`, to_email, message);
                    console.log('Message sent successfully');
                } catch (error) {
                    console.error('Error sending message:', error);
                }
            }

        async function sendMessageFile(chatUserID, to_email, content, type) {
            const times = Date.now().toString();
            const receiverIds = chatUserID;
            const messages = {
                toId: receiverIds,
                read: '',
                type: type,
                fromId: current_user.uid,
                readUsers: {[current_user.uid]: true, [receiverIds]: false},
                sent: times
            };

            const currentDate = new Date();
            const day = currentDate.getDate().toString().padStart(2, '0');
            const month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
            const year = currentDate.getFullYear().toString();

            messages.fileUrl = content;
            messages.fileName = `Đơn thuốc-${day}/${month}/${year}`;

            let conversationIDs = getConversationID(chatUserID);
            const refs = collection(database, `chats/${conversationIDs}/messages/`);

            try {
                await setDoc(doc(refs, times), messages);
                await pushNotification(to_email, `Đơn thuốc-${day}/${month}/${year}`);
                await updateLastMessage(chatUserID, messages);
                await saveMessage(`{{ Auth::user()->email }}`, to_email, messages);
            } catch (error) {
                console.error('Error sending message:', error);
            }
        }

        async function handleSuccess(response) {
            try {
                await sendMessage(chatUserId, emailUser, response.prescription_id, 'prescription');
                await sendMessageFile(chatUserId, emailUser, response.pdf_path, 'file');
                alert('Create success!');
                window.location.href = `{{ route('view.prescription.result.doctor') }}`;
            } catch (error) {
                console.error('Error in handleSuccess:', error);
            }
        }

            try {
                $.ajax({
                    url: `{{ route('api.backend.prescription.result.create') }}`,
                    method: 'POST',
                    headers: headers,
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: formData,
                    success: function (response) {
                        handleSuccess(response);
                    },
                    error: function (error) {
                        alert(error.responseJSON.message);
                    }
                });
            } catch (e) {
                console.log(e);
            }
        }
    );


    loadData_widgetChat();


    function loadData_widgetChat() {
        $('.service_name_item').on('click', function () {
            let my_array = null;
            let my_name = null;
            $(this).parent().parent().find(':checkbox:checked').each(function (i) {
                let value = $(this).val();
                if (my_array) {
                    my_array = my_array + ',' + value;
                } else {
                    my_array = value;
                }

                let name = $(this).data('name');
                if (my_name) {
                    my_name = my_name + ', ' + name;
                } else {
                    my_name = name;
                }
            });
            $(this).parent().parent().prev().val(my_name);
            $(this).parent().parent().next().find('input').val(my_array);
        })
    }


    $(".handleSearchMedicine").on("input", function () {
        loadListMedicine();
    });
    $(".handleSearchMedicineChange").on("change", function () {
        loadListMedicine();
    });

    async function getIngredientsByMedicineId(id) {
        let url = `{{ route('medicine.get-ingredients-by-medicine-id', ['id' => ':id']) }}`;
        url = url.replace(':id', id);

        let result = await fetch(url, {
            method: 'GET',
        });

        if (result.ok) {
            let data = await result.json();
            return data;
        }

        return {
            'component_name': ''
        };
    }

    function formatDate(timestamp) {
        const date = new Date(parseInt(timestamp));

        const h = "0" + date.getHours();
        const m = "0" + date.getMinutes();

        return `${h.slice(-2)}:${m.slice(-2)}`;
    }

    function random(min, max) {
        return Math.floor(Math.random() * (max - min) + min);
    }
</script>
