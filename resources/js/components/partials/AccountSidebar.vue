<template>
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
        <img src="http://placekitten.com/100/100" alt="avatar" width="100px" height="100px">
        <span class="fs-4">User Name</span>
        <hr>
        <ul class="nav nav-pills flex-column profile-sidebar">
            <li class="nav-item">
                <div class="nav-link active" aria-current="page">
                    Настройки
                </div>
            </li>
            <li>
                <div class="nav-link text-white">
                    Словари
                </div>
            </li>
            <li>
                <div href="#" class="nav-link text-white">
                    Достижения
                </div>
            </li>

            <li>
                <div href="#" class="nav-link text-white">
                    Группы
                </div>
            </li>
            <li>
                <div href="#" class="nav-link text-white">
                    Школы
                </div>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
               id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="http://placekitten.com/32/32" alt="" width="32" height="32" class="rounded-circle me-2">
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
    margin-bottom: 450px;
}
</style>
