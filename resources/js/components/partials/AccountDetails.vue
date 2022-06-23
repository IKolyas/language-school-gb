<template>
    <div class="d-flex flex-wrap justify-content-between py-3 mb-4 border-bottom">
        <span class="fs-4">Настройте свой профиль</span>
        <ul class="nav nav-pills d-flex flex-wrap justify-content-between achivement-list">
            <li class="nav-item">
                <div class="card bg-info" style="width: 180px">
                    <div class="card-body text-center">
                        <p class="card-text">занимаешься</p>
                        <h3 class="card-title">62</h3>
                        <p class="card-text">дня</p>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <div class="card bg-success" style="width: 180px">
                    <div class="card-body text-center">
                        <p class="card-text">Выучил</p>
                        <h3 class="card-title">2700</h3>
                        <p class="card-text">новых слов</p>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <div class="card bg-warning" style="width: 180px">
                    <div class="card-body text-center">
                        <p class="card-text">знаешь</p>
                        <h3 class="card-title">4300</h3>
                        <p class="card-text">слов</p>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <img src="http://placekitten.com/200/200" alt="" width="300" height="300"><br>
    <form>
        <div class="mb-3">
            <label for="formFile" class="form-label">Выберите новый аватар</label>
            <input class="form-control" type="file" id="formFile">
        </div>
        <div class="row g-2">
            <div class="col-md">
                <div class="form-floating">
                    <input type="email" class="form-control" id="floatingInputGridEmail" placeholder="name@example.com"
                           value="current email">
                    <label for="floatingInputGridEmail">Email address</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <input type="email" class="form-control" id="floatingInputGrid" placeholder="password"
                           value="*******">
                    <label for="floatingInputGrid">Password</label>
                </div>
            </div>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="notifyCheckbox" checked>
            <label class="form-check-label" for="notifyCheckbox">Sent me notifications</label>
        </div>
        <div class="row g-2">
            <div class="col-md">
                <div class="form-floating">
                    <input type="email" class="form-control" id="floatingInputGridName" placeholder="name"
                           value="current name">
                    <label for="floatingInputGridName">Your name</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <input type="email" class="form-control" id="floatingInputLastname" placeholder="lastname"
                           value="Current lastname">
                    <label for="floatingInputLastname">Your lastname</label>
                </div>
            </div>
        </div>
        <div class="mb-3">
            About you
            <input type="textarea" class="form-control" value="current user info" style="height: 100px"
                   placeholder="tell about yourself">
        </div>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </form>
</template>

<script>
export default {
    name: "AccountDetails"
}
</script>

<style scoped>
.achivement-list {
    width: 600px;
}
</style>
