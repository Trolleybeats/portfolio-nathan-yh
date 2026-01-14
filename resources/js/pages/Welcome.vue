<script setup lang="ts">
import {
    Card,
    CardContent,
    CardDescription,
    CardTitle,
} from '@/components/ui/card';
import { Head } from '@inertiajs/vue3';

const props = withDefaults(
    defineProps<{
        canRegister: boolean;
        profil: any;
        technologies: any[];
        projets: any[];
        education: any[];
        experiences: any[];
    }>(),
    {
        canRegister: true,
    },
);

const envoyerMail = () => {
    window.location.href = `mailto:${props.profil.email}`;
};
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div
        class="sticky top-0 flex w-full bg-[#FDFDFC] px-6 py-4 text-[#1b1b18] lg:px-8 dark:bg-[#0a0a0a]"
    >
        <header
            class="w-full border-b border-black/10 pb-4 dark:border-white/10"
        >
            <div class="flex items-start justify-between gap-6">
                <div class="min-w-0">
                    <h1
                        class="text-lg leading-tight font-semibold tracking-tight"
                    >
                        {{ profil.nom }} {{ profil.prenom }}
                    </h1>
                    <p
                        v-if="profil?.titre"
                        class="mt-1 text-sm text-black/70 dark:text-white/70"
                    >
                        {{ profil.titre }}
                    </p>
                </div>

                <nav class="flex flex-wrap justify-end gap-x-6 gap-y-4 pt-0.5">
                    <a
                        href="#technologies"
                        class="text-sm text-black hover:underline dark:text-blue-400"
                        >Technologies</a
                    >
                    <a
                        href="#projets"
                        class="text-sm text-black hover:underline dark:text-blue-400"
                        >Projets</a
                    >
                    <a
                        href="#experiences"
                        class="text-sm text-black hover:underline dark:text-blue-400"
                        >Expériences</a
                    >
                    <a
                        href="#education"
                        class="text-sm text-black hover:underline dark:text-blue-400"
                        >Éducation</a
                    >
                </nav>
            </div>
        </header>
    </div>
    <div class="flex items-center gap-8 p-8">
        <div class="flex-1">
            <h2>Bonjour, je m'appelle {{ profil.nom }} {{ profil.prenom }}</h2>
            <p>{{ profil.titre }}</p>
            <p>{{ profil.bio }}</p>
            <button
                class="mt-4 cursor-pointer rounded-sm bg-[#191400] px-5 py-1.5 text-sm leading-normal text-[#FDFDFC] hover:bg-[#2c2a00] dark:bg-[#EDEDEC] dark:text-[#1b1b18] dark:hover:bg-[#c4c2bd]"
                @click="envoyerMail"
            >
                Contactez-moi
            </button>
        </div>
        <figure class="flex-shrink-0">
            <img
                :src="`/storage/${profil.profil_photo}`"
                :alt="`Photo de profil de ${profil.prenom} ${profil.nom}`"
                class="h-64 w-64 rounded-lg object-cover"
            />
        </figure>
    </div>
    <div class="p-8" id="technologies">
        <h2 class="mb-4 text-2xl font-bold">Technologies</h2>
        <div class="grid grid-cols-2 gap-4 md:grid-cols-4 lg:grid-cols-6">
            <div
                v-for="tech in technologies"
                :key="tech.id"
                class="flex flex-col items-center"
            >
                <p class="text-center">{{ tech.nom }}</p>
                <p class="text-gray-600">{{ tech.categorie }}</p>
                <p class="text-sm text-gray-500">{{ tech.niveau }}</p>
            </div>
        </div>
    </div>
    <div class="flex flex-row flex-wrap p-8" id="projets">
        <h2 class="mb-4 w-full text-2xl font-bold">Projets</h2>
        <Card
            v-for="projet in projets"
            :key="projet.id"
            class="m-4 mb-4 flex-1"
        >
            <CardContent>
                <CardTitle>{{ projet.titre }}</CardTitle>
                <CardDescription>{{
                    projet.description_courte
                }}</CardDescription>
            </CardContent>
        </Card>
    </div>
    <div class="p-8" id="experiences">
        <h2 class="mb-4 text-2xl font-bold">Expériences</h2>
        <div
            v-for="experience in experiences"
            :key="experience.id"
            class="mb-6"
        >
            <h3 class="text-xl font-semibold">{{ experience.poste }}</h3>
            <p class="text-gray-600">{{ experience.entreprise }}</p>
            <p class="text-gray-600">{{ experience.type }}</p>
            <p class="text-sm text-gray-500">
                {{ experience.date_debut }} -
                {{ experience.date_fin || 'Présent' }}
            </p>
            <div v-html="experience.description"></div>
        </div>
    </div>
    <div class="p-8" id="education">
        <h2 class="mb-4 text-2xl font-bold">Éducation</h2>
        <div v-for="educ in education" :key="educ.id" class="mb-6">
            <h3 class="text-xl font-semibold">{{ educ.diplome }}</h3>
            <p class="text-gray-600">{{ educ.etablissement }}</p>
            <p class="text-sm text-gray-500">
                {{ educ.date_obtention }}
            </p>
            <div v-html="educ.description"></div>
        </div>
    </div>
</template>
