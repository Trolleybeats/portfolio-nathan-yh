<script setup>
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    profil: {
        type: Object,
        default: null,
    },
});

const form = useForm({
    _method: null,
    nom: props.profil?.nom ?? '',
    prenom: props.profil?.prenom ?? '',
    titre: props.profil?.titre ?? '',
    bio: props.profil?.bio ?? '',
    profil_photo: null,
    email: props.profil?.email ?? '',
    telephone: props.profil?.telephone ?? '',
    adresse: props.profil?.adresse ?? '',
    disponibilite: props.profil?.disponibilite ?? '',
    linkedin: props.profil?.linkedin ?? '',
    github: props.profil?.github ?? '',
    cv: null,
});

const onProfilPhotoChange = (event) => {
    form.profil_photo = event?.target?.files?.[0] ?? null;
};

const onCvChange = (event) => {
    form.cv = event?.target?.files?.[0] ?? null;
};

const submit = () => {
    const profilId = props.profil?.id;
    if (profilId) {
        form._method = 'put';
        form.post(`/profil/${profilId}`, {
            forceFormData: true,
            onFinish: () => {
                form._method = null;
            },
        });
        return;
    }

    form.post('/profil', {
        forceFormData: true,
        onSuccess: () => form.reset('profil_photo', 'cv'),
    });
};

const flashSuccess = computed(() => usePage().props?.flash?.success);
const flashError = computed(() => usePage().props?.flash?.error);
</script>
<template>
    <AppLayout>
        <div class="p-8">
            <h1 class="mb-4 text-4xl font-bold">Mon Profil</h1>
            <!--Formulaire description profil-->

            <div v-if="flashSuccess" class="mb-4 rounded-lg border p-3 text-sm">
                {{ flashSuccess }}
            </div>
            <div v-if="flashError" class="mb-4 rounded-lg border p-3 text-sm">
                {{ flashError }}
            </div>

            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label
                        for="nom"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >Nom *</label
                    >
                    <input
                        type="text"
                        id="nom"
                        class="p- 2.5 block w-full rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                        v-model="form.nom"
                    />
                    <p
                        class="mt-2 text-sm text-red-600 dark:text-red-500"
                        v-if="form.errors.nom"
                    >
                        {{ form.errors.nom }}
                    </p>
                </div>
                <div class="mb-4">
                    <label
                        for="prenom"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >Prénom *</label
                    >
                    <input
                        type="text"
                        id="prenom"
                        class="p- 2.5 block w-full rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                        v-model="form.prenom"
                    />
                    <p
                        class="mt-2 text-sm text-red-600 dark:text-red-500"
                        v-if="form.errors.prenom"
                    >
                        {{ form.errors.prenom }}
                    </p>
                </div>
                <div class="mb-4">
                    <label
                        for="titre"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >Titre *</label
                    >
                    <input
                        type="text"
                        id="titre"
                        class="p- 2.5 block w-full rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                        v-model="form.titre"
                    />
                    <p
                        class="mt-2 text-sm text-red-600 dark:text-red-500"
                        v-if="form.errors.titre"
                    >
                        {{ form.errors.titre }}
                    </p>
                </div>
                <div class="mb-4">
                    <label
                        for="bio"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >Bio *</label
                    >
                    <textarea
                        id="bio"
                        rows="4"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                        v-model="form.bio"
                    ></textarea>
                    <p
                        class="mt-2 text-sm text-red-600 dark:text-red-500"
                        v-if="form.errors.bio"
                    >
                        {{ form.errors.bio }}
                    </p>
                </div>
                <div class="mb-4">
                    <label
                        for="profil_photo"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >Photo de profil</label
                    >
                    <input
                        type="file"
                        id="profil_photo"
                        class="p- 2.5 block w-full rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                        @change="onProfilPhotoChange"
                    />
                    <p
                        class="mt-2 text-sm text-red-600 dark:text-red-500"
                        v-if="form.errors.profil_photo"
                    >
                        {{ form.errors.profil_photo }}
                    </p>
                </div>
                <div class="mb-4">
                    <label
                        for="email"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >Email</label
                    >
                    <input
                        type="email"
                        id="email"
                        class="p- 2.5 block w-full rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                        v-model="form.email"
                    />
                    <p
                        class="mt-2 text-sm text-red-600 dark:text-red-500"
                        v-if="form.errors.email"
                    >
                        {{ form.errors.email }}
                    </p>
                </div>
                <div class="mb-4">
                    <label
                        for="telephone"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >Téléphone</label
                    >
                    <input
                        type="tel"
                        id="telephone"
                        class="p- 2.5 block w-full rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                        v-model="form.telephone"
                    />
                    <p
                        class="mt-2 text-sm text-red-600 dark:text-red-500"
                        v-if="form.errors.telephone"
                    >
                        {{ form.errors.telephone }}
                    </p>
                </div>
                <div class="mb-4">
                    <label
                        for="adresse"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >Adresse</label
                    >
                    <input
                        type="text"
                        id="adresse"
                        class="p- 2.5 block w-full rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                        v-model="form.adresse"
                    />
                    <p
                        class="mt-2 text-sm text-red-600 dark:text-red-500"
                        v-if="form.errors.adresse"
                    >
                        {{ form.errors.adresse }}
                    </p>
                </div>
                <div class="mb-4">
                    <label
                        for="disponibilite"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >Disponibilité</label
                    >
                    <input
                        type="text"
                        id="disponibilite"
                        class="p- 2.5 block w-full rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                        v-model="form.disponibilite"
                    />
                    <p
                        class="mt-2 text-sm text-red-600 dark:text-red-500"
                        v-if="form.errors.disponibilite"
                    >
                        {{ form.errors.disponibilite }}
                    </p>
                </div>
                <div class="mb-4">
                    <label
                        for="linkedin"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >LinkedIn</label
                    >
                    <input
                        type="text"
                        id="linkedin"
                        class="p- 2.5 block w-full rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                        v-model="form.linkedin"
                    />
                    <p
                        class="mt-2 text-sm text-red-600 dark:text-red-500"
                        v-if="form.errors.linkedin"
                    >
                        {{ form.errors.linkedin }}
                    </p>
                </div>
                <div class="mb-4">
                    <label
                        for="github"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >GitHub</label
                    >
                    <input
                        type="text"
                        id="github"
                        class="p- 2.5 block w-full rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                        v-model="form.github"
                    />
                    <p
                        class="mt-2 text-sm text-red-600 dark:text-red-500"
                        v-if="form.errors.github"
                    >
                        {{ form.errors.github }}
                    </p>
                </div>
                <div class="mb-4">
                    <label
                        for="cv"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >CV</label
                    >
                    <input
                        type="file"
                        id="cv"
                        class="p- 2.5 block w-full rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                        @change="onCvChange"
                    />
                    <p
                        class="mt-2 text-sm text-red-600 dark:text-red-500"
                        v-if="form.errors.cv"
                    >
                        {{ form.errors.cv }}
                    </p>
                </div>
                <Button type="submit" :disabled="form.processing"
                    >Enregistrer</Button
                >
            </form>

            <div class="space-y-4">
                <Card>
                    <div>
                        <h2 class="text-2xl font-semibold">Nom:</h2>
                        <p>{{ form.nom }}</p>
                    </div>
                    <div>
                        <h2 class="text-2xl font-semibold">Prénom:</h2>
                        <p>{{ form.prenom }}</p>
                    </div>
                    <div>
                        <h2 class="text-2xl font-semibold">Titre:</h2>
                        <p>{{ form.titre }}</p>
                    </div>
                    <div>
                        <h2 class="text-2xl font-semibold">Bio:</h2>
                        <p>{{ form.bio }}</p>
                    </div>
                    <div>
                        <h2 class="text-2xl font-semibold">Email:</h2>
                        <p>{{ form.email }}</p>
                    </div>
                    <div>
                        <h2 class="text-2xl font-semibold">Téléphone:</h2>
                        <p>{{ form.telephone }}</p>
                    </div>
                    <div>
                        <h2 class="text-2xl font-semibold">Adresse:</h2>
                        <p>{{ form.adresse }}</p>
                    </div>
                    <div>
                        <h2 class="text-2xl font-semibold">Disponibilité:</h2>
                        <p>{{ form.disponibilite }}</p>
                    </div>
                    <div>
                        <h2 class="text-2xl font-semibold">LinkedIn:</h2>
                        <p>{{ form.linkedin }}</p>
                    </div>
                    <div>
                        <h2 class="text-2xl font-semibold">GitHub:</h2>
                        <p>{{ form.github }}</p>
                    </div>
                    <div>
                        <h2 class="text-2xl font-semibold">CV:</h2>
                        <p>{{ form.cv?.name ?? '' }}</p>
                    </div>
                </Card>
            </div>
        </div>
    </AppLayout>
</template>
