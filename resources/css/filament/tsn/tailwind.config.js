import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/Tsn/**/*.php',
        './resources/views/filament/tsn/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
}
