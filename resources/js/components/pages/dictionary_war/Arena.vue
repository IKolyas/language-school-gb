<template>
    <div class="main">
        <div class="users">
            <button class="btn" :disabled="!userInviteId" @click="createArena()">
                Пригласить
            </button>
            <div class="user-list" v-for="user in getUserList">
                <span
                    :class="[
                        userActiveList.includes(user.id) ? 'user_active' : '', userInviteId === user.id ? 'user_invite' : '']"
                    @click="userActiveList.includes(user.id) ? setUserInvite(user.id) : ''"
                >{{ user.name }} {{ user.lastname }}
                </span>
            </div>
        </div>
        <div class="board">
            <div class="opponent dictionary">
                <div class="words">
                    <span class="word"
                          v-for="(answer, index) in dictionary_answers.slice(0, 5)"
                          :key="index"
                          :data-opponent-word="answer.id"
                    >
                         {{ answer.word }}
                    </span>
                </div>
            </div>
            <div class="arena">
                <div class="user_icon__opponent"><i class="bi bi-person-fill"></i> {{getOpponent}}</div>

                <div class="timer">таймер: 0 шаг: {{ currentStep }}/10</div>

                <div class="round"></div>

                <div class="success">
                    <button class="btn" v-if="usersReady" @click="gameStart()">Начать</button>
                    <button class="btn" v-else>Ожидание</button>
                </div>

                <div class="user_icon"><i class="bi bi-person-fill"></i> {{getUser}} <span v-if="selfStep">Ваш ход!</span></div>
            </div>
            <div class="user dictionary">
                <div class="words">
                    <span class="word"
                          v-for="(answer, index) in dictionary_answers.slice(5)"
                          :key="index"
                          :data-user-word="answer.id"
                    >
                        {{ answer.word }}
                    </span>
                </div>
                <div class="words translation">
                    <span class="word word__translation"
                          v-for="(answer, index) in dictionary_answers.slice(0, 5)"
                          :key="index"
                          :data-user-translation="answer.id"
                    >
                        {{ answer.translation }}
                    </span>
                </div>
            </div>
        </div>


        <!--        <div class="actions">-->
        <!--            <button @click="createArena">Создать комнату</button>-->
        <!--            <button @click="nextStep">Следующий шаг</button>-->
        <!--            <h2>Current step: {{ currentStep }}</h2>-->
        <!--        </div>-->


    </div>
</template>

<script>

export default {
    name: "Arena",
    data: () => {
        return {

            userList: [],
            userActiveList: [],
            dictionary_answers: [
                {
                    id: 0,
                    word: 'word',
                    translation: 'слово'
                },
                {
                    id: 1,
                    word: 'azure',
                    translation: 'лазурный'
                },
                {
                    id: 2,
                    word: 'beige',
                    translation: 'бежевый'
                },
                {
                    id: 3,
                    word: 'black',
                    translation: 'чёрный'
                },
                {
                    id: 4,
                    word: 'blue',
                    translation: 'синий'
                },
                {
                    id: 5,
                    word: 'brown',
                    translation: 'коричневый'
                },
                {
                    id: 6,
                    word: 'copper',
                    translation: 'медный'
                },
                {
                    id: 7,
                    word: 'crimson',
                    translation: 'малиновый'
                },
                {
                    id: 8,
                    word: 'golden',
                    translation: 'золотой'
                },
                {
                    id: 9,
                    word: 'gray',
                    translation: 'серый'
                }
            ],

            role: 'owner',
            userInviteId: null,

            game: {
                step: null,
                active_word_id: null,
                user: null,
                opponent: null
            }
        }
    },
    computed: {
        getOpponent: function() {
            return this.game.opponent;
        },
        getUser: function() {
            return this.game.user;
        },

        selfStep: function () {
            return !this.game.step % 2 === 0
        },

        usersReady: function () {
            return this.game.user !== null && this.game.opponent !== null;
        },

        currentStep: function () {
            return this.game.step;
        },

        getUserList: function () {
            return this.userList;
        },

        getUserActiveList: function () {
            return this.userActiveList;
        }
    },
    mounted() {
        // window.Echo.channel('test-channel').listen('Arena', (e) => {
        //     console.log(e)
        //     let room = JSON.parse(e.room)
        //     console.log(room)
        //     this.step = room.step
        // })



    },
    created() {
        axios.get('/api/arena/get-users').then((response) => {
            this.userList = response.data.users;
        })

        if (this.$route.params.id) {
            this.game.opponent = this.$route.params.name;
        }

        setInterval(() => {
            axios.get('/api/arena/users-active')
        }, 30000)

        window.Echo.channel('users-active').listen('UserActiveArena', (e) => {
            console.log(e)
            let users = JSON.parse(e.users)
            console.log(users)
            this.userActiveList = users
        })
    },
    methods: {
        gameStart() {
            this.game.user = this.$store.getters['user/name'];
            this.game.step = 1;
        },
        setUserInvite(id) {
            this.userInviteId = id;
        },
        createArena() {
            axios.get(`/api/arena/create-arena?user_id=${this.userInviteId}`);
        },
        nextStep() {
            axios.get('/api/arena/next-step');
        }
    }
}
</script>

<style lang="scss" scoped>
.main {
    display: grid;
    grid-template-columns: auto 1000px;
    justify-content: center;
    align-items: flex-start;

    .btn {
        font-family: Source Sans Pro, sans-serif;
        font-size: 24px;
        font-weight: 400;
        border-radius: 10px;
        border: 1px solid #256C39;
        color: #256C39;
        padding: 2px;
        background-color: #FFF;
        &:hover {
            cursor: pointer;
            background-color: #256C39;
            color: #FFF;
        }
    }

    .board {
        margin: 10px;
        width: 1000px;
        height: 800px;
        display: grid;
        grid-template-rows: 1fr 8fr 1fr;
        align-items: center;
        background-color: rgba(117, 190, 218, 0.4);
        border-radius: 5px;
        border-color: #1a2226;

        .opponent .word {
            transform: rotateX(180deg);
            //color: #f1f1f1;
            color: #0dcaf0 !important;

        }

        .arena {
            width: 600px;
            height: 400px;
            background-color: rgba(121, 193, 220, 0.09);
            border-radius: 10px;
            justify-self: center;
            display: grid;
            grid-template-areas:
            "U U U U  U U U U  U U U U"
            "T T R R  R R R R  R R M M"
            "O O O O  O O O O  O O O O";

            .user_icon {
                grid-area: U;
                display: flex;
                justify-self: center;
                align-self: center;
                color: blue;

                i {
                    font-size: 36px;
                }
            }

            .user_icon__opponent {
                grid-area: O;
                display: flex;
                justify-self: center;
                align-self: center;
                color: red;

                i {
                    font-size: 36px;
                }
            }

            .timer {
                grid-area: T;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .round {
                grid-area: R;
            }

            .success {
                grid-area: M;
                display: flex;
                justify-content: center;
                align-items: center;
            }

        }

        .dictionary {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            padding: 10px;

            .words {
                display: flex;
                justify-content: space-around;
                align-items: center;
                width: 100%;

                .word {
                    border: 3px solid #d2c5c5;
                    border-radius: 10px;
                    padding: 5px 5px;
                    color: #f1f1f1;
                    font-family: Source Sans Pro, sans-serif;
                    background-color: #0dcaf0;
                    font-size: 32px;
                    font-weight: 400;
                    min-width: 86px;
                    min-height: 48px;
                    text-align: center;
                }

                &:hover {
                    cursor: pointer;
                }

                .word__translation {
                    background-color: #00ca6d;
                }
            }

        }
    }
}

.actions {
    display: flex;
    gap: 10px;
}

.users {
    margin: 10px;
    max-height: 100%;
    overflow-y: auto;
    .btn {
        width: 100%;
    }
    .user-list {
        display: flex;
        gap: 10px;
        span {
            min-height: 15px;
            padding: 2px;
            width: 100%;
        }

        .user_active {
            background-color: green;
            border-radius: 5px;
            color: #dde3e8;
            font-weight: 400;
        }

        .user_invite {
            border: 2px solid red;
        }
    }
}

</style>
