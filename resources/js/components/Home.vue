<template>
    <v-app>
            
        <v-row>

            <v-col xs="12" sm="6">
                <v-card
                    class="mx-auto"
                    max-width="400"
                >
                    <v-img class="white--text align-end" height="200px" src="https://cdn.vuetifyjs.com/images/cards/docks.jpg">
                        <v-card-title>Top 10 Australian beaches</v-card-title>
                    </v-img>

                    <v-card-subtitle class="pb-0">Number 10</v-card-subtitle>

                    <v-card-text class="text--primary">
                        <div>Whitehaven Beach</div>

                        <div>Whitsunday Island, Whitsunday Islands</div>
                    </v-card-text>

                    <v-card-actions class="justify-center">
                        <v-btn
                            color="orange"
                            text
                            @click="dialog = true"
                        >
                            Action
                        </v-btn>

                        <v-btn
                            color="orange"
                            text
                        >
                            Explore
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>

            <v-col xs="12" sm="6">
                <v-card
                    class="mx-auto"
                    max-width="400"
                >
                    <v-img
                    class="white--text align-end"
                    height="200px"
                    src="https://cdn.vuetifyjs.com/images/cards/house.jpg"
                    >
                    <v-card-title>Top 10 Australian beaches</v-card-title>
                    </v-img>

                    <v-card-subtitle class="pb-0">Number 10</v-card-subtitle>

                    <v-card-text class="text--primary">
                        <div>Whitehaven Beach</div>

                        <div>Whitsunday Island, Whitsunday Islands</div>
                    </v-card-text>

                    <v-card-actions class="justify-center">
                        <v-btn
                            color="orange"
                            text
                            
                        >
                            Action
                        </v-btn>

                        <v-btn
                            color="orange"
                            text
                        >
                            Explore
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>

        </v-row>

        <!-- MODAL -->
        <v-dialog v-model="dialog" width="500" persistent >
            <v-card>
                <v-card-title
                class="headline grey lighten-2"
                primary-title
                >
                Privacy Policy
                </v-card-title>

                <v-card-text>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </v-card-text>

                <v-divider></v-divider>

                <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="primary"
                    text
                    @click="dialog = false"
                >
                    Cancel
                </v-btn>

                <v-btn
                    color="danger"
                    text
                    @click="dialog = false"
                >
                    I accept
                </v-btn>

                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- END MODAL -->

    </v-app>
</template>

<script>

    export default {
        data (){
            return {
                dialog: false,
            }
        },
    };

</script>