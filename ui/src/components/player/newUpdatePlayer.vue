<template>
<div>
    <!-- <pre>{{player}}</pre> -->
    <b-modal :title="player ?   $t('edit')+' '+ player.name : $t('addNew')" :visible="true" hide-footer @hide="$emit('close')" size="xl">
        <form @submit.prevent="addUpdate()">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="name" class="col-md-4 control-label">{{ $t('name') }}</label>
                    <input v-model="form.name" id="name" type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="level" class="col-md-4 control-label">{{ $t('Level') }}</label>
                    <input v-model="form.level" id="level" min="0" max="99" type="number" class="form-control" name="level" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="class" class="col-md-4 control-label">{{ $t('Class') }}</label>
                    <input v-model="form.class" id="class" type="text" class="form-control" name="class" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="class" class="col-md-4 control-label">{{ $t('Game') }}</label>
                    <b-select v-model="form.game_id">
                        <option v-for="game in $store.data.games" :key="game.id" :value="game.id" >
                            {{ game.name }}
                        </option>
                    </b-select>
                </div>
            </div>

            <!-- <div v-if="$store.data.params" class="text-center " id="extra_param_modal_title"><p>{{ $t('extra_params') }}</p></div> -->

            <div class="row">
                <div v-for="param in $store.data.params.filter(p => p.game_id == form.game_id)" :key="param.id" class="form-group col-md-6">
                    <label for="class" class="col-md-4 control-label">{{param.name}}</label>
                    <input v-model="form.extra_params[param.name]"  type="text" class="form-control"  >
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <b-button type="submit" class="mt-3 " block>
                        {{ player ? $t('edit') : $t('addNew') }}
                    </b-button>
                </div>
                <div class="col-sm-6">
                    <b-button class="mt-3" variant="danger" block @click="$emit('close')">
                        {{ $t('cancel') }}
                    </b-button>
                </div>
            </div>

            <!-- <b-button v-else class="mt-3" block @click="addUpdate()">{{ $t('edit') }}</b-button> -->
        </form>
    </b-modal>
</div>
</template>

<script>
export default {
    name: 'newUpdatePlayer',
    props: {
        player: {
            type: Object,
            required: false,
        }
    },
    data() {
        return {
            form: this.player ? this.$store.clone(this.player) : {
                extra_params:{}
            },
        }
    },
    methods: {
        addUpdate() {
            this.$http.post('players', this.form).then(() => {
                this.$parent.getPlayers()
                this.$emit('close')
            })
        },
    }
}
</script>
<style lang="scss" >
    #extra_param_modal_title{

    }

</style>
