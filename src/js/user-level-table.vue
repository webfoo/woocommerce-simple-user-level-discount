<template>
    
    <div>
        <table class="form-table user_level_table wc_emails widefat">
            <thead>
                <tr>
                    <th>Level Name</th>
                    <th>Discount Percent</th>
                    <th width="20" style="width:20px">
                        <a href="#add-row" @click=addRow()>&plus;</a>
                    </th>
                </tr>
            </thead>
            <tbody>

                <tr 
                    v-for="(discount, index) in discounts"
                    :key=index>
                    <td><input type="text" v-model=discounts[index].name></td>
                    <td><input type="number" step=0.01 v-model=discounts[index].value></td>
                    <td>
                        <a href="#remove-row" @click=removeRow(index)>&times;</a>
                    </td>
                </tr>

            </tbody>
        </table>
        <input type="hidden" :name=name :value=normalised>

    </div>
    
</template>

<script>
    export default {
        props: ['name', 'value'],
        data() {
            return {
                discounts: []
            }
        },
        computed: {
            normalised() {
                let normalised = {}

                this.discounts.forEach(function(discount) {
                    if (discount.name && discount.value) {
                        normalised[discount.name] = discount.value
                    }
                })

                return JSON.stringify(normalised)
            }
        },
        methods: {
            addRow() {
                this.discounts.push({})
            },
            removeRow(index) {
                this.$delete(this.discounts, index)
            }
        },
        mounted() {
            for (const property in this.value) {
                this.discounts.push({
                    name: property,
                    value: this.value[property]
                })
            }
        }
    }
</script>