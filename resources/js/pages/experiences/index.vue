<script setup>
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    poste: '',
    entreprise: '',
    lieu: '',
    type: '',
    date_debut: '',
    date_fin: '',
    description: '',
});

defineProps(['experiences']);

const submit = () => {
    form.post('/experiences', {
        onSuccess: () => form.reset(),
    });
};
</script>
<template>
    <AppLayout>
        <div class="mt-8 mr-8 ml-8 flex items-center justify-between">
            <h1 class="text-4xl font-bold">Mon expérience</h1>
        </div>
        <!--Formulaire ajout expérience-->
        <form
            @submit.prevent="submit"
            class="m-8 flex flex-col gap-4 rounded-lg border p-6 shadow-md"
        >
            <div>
                <label for="poste" class="block font-medium">Poste</label>
                <input
                    v-model="form.poste"
                    type="text"
                    id="poste"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                />
            </div>
            <div>
                <label for="entreprise" class="block font-medium"
                    >Entreprise</label
                >
                <input
                    v-model="form.entreprise"
                    type="text"
                    id="entreprise"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                />
            </div>
            <div>
                <label for="lieu" class="block font-medium">Lieu</label>
                <input
                    v-model="form.lieu"
                    type="text"
                    id="lieu"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                />
            </div>
            <div>
                <label for="type" class="block font-medium">Type</label>
                <select
                    v-model="form.type"
                    id="type"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                >
                    <option value="Stage">Stage</option>
                    <option value="Emploi">Emploi</option>
                    <option value="Freelance">Freelance</option>
                </select>
            </div>
            <div>
                <label for="date_debut" class="block font-medium"
                    >Date de début</label
                >
                <input
                    v-model="form.date_debut"
                    type="date"
                    id="date_debut"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                />
            </div>
            <div>
                <label for="date_fin" class="block font-medium"
                    >Date de fin</label
                >
                <input
                    v-model="form.date_fin"
                    type="date"
                    id="date_fin"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                />
            </div>
            <div>
                <label for="description" class="block font-medium"
                    >Description</label
                >
                <textarea
                    v-model="form.description"
                    id="description"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                ></textarea>
            </div>
            <button
                type="submit"
                class="self-end rounded bg-blue-600 px-4 py-2 font-medium text-white hover:bg-blue-700"
            >
                Ajouter l'expérience
            </button>
        </form>

        <!--Liste des expériences-->
        <div class="grid gap-6 p-8 md:grid-cols-2 lg:grid-cols-3">
            <Card
                v-for="exp in experiences"
                :key="exp.id"
                class="cursor-pointer transition-shadow hover:shadow-lg"
            >
                <CardHeader>
                    <CardTitle>{{ exp.poste }}</CardTitle>
                </CardHeader>
                <CardContent>
                    <p>{{ exp.entreprise }}</p>
                    <p>{{ exp.lieu }}</p>
                    <p>
                        {{ exp.date_debut }} - {{ exp.date_fin || 'Présent' }}
                    </p>
                    <p>{{ exp.description }}</p>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
