<template>
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark">
        <img src="http://placekitten.com/100/100" alt="avatar" width="100px" height="100px">
        <span class="fs-4">User Name</span>
        <hr>
        <ul class="nav nav-pills flex-column profile-sidebar" id="sidebarTab" role="tablist">
            <li class="nav-item" role="presentation">
                <div
                    class="nav-link active" id="account-details-tab" data-bs-toggle="pill"
                    data-bs-target="#account-details-pane"
                    role="tab" aria-controls="pills-account-details" aria-selected="true">Настройки
                </div>
            </li>
            <li class="nav-item" role="presentation">
                <div class="nav-link"
                     id="dictionaries-tab" data-bs-toggle="pill" data-bs-target="#dictionaries-pane"
                     role="tab" aria-controls="pills-dictionaries" aria-selected="false">Словари
                </div>
            </li>
            <li class="nav-item" role="presentation">
                <div class="nav-link" id="achievements-tab" data-bs-toggle="pill" data-bs-target="#achievements-pane"
                     role="tab" aria-controls="pills-achievements" aria-selected="false">Достижения
                </div>
            </li>
            <li class="nav-item" role="presentation">
                <div class="nav-link" id="groups-tab" data-bs-toggle="pill" data-bs-target="#groups-pane"
                     role="tab" aria-controls="pills-groups" aria-selected="false">Группы
                </div>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
               id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-info-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path
                        d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                </svg>
                <strong>Помощь</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownHelp">
                <li><a class="dropdown-item" href="#">Написать в техподдержку</a></li>
                <li><a class="dropdown-item" href="#">Задать вопрос психологу</a></li>
                <li><a class="dropdown-item" href="#">Мне не нужна помощь</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Я просто хочу уйти</a></li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: "AccountSidebar"
}
</script>

<style scoped>
.profile-sidebar {
    margin-bottom: 530px;
    width: 280px;
}
</style>
