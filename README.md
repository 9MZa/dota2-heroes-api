# How to use

## Start Project

```
php -S localhost:8000 -t api api/index.php
```

## API Call


### Endpoint

for all heroes

```
https://dota2-heroes-api.vercel.app/heroes
```

for single hero

```
https://dota2-heroes-api.vercel.app/hero?name=Nyx
```

### Result

```
{
    "id": 69,
    "name": "Nyx Assassin",
    "primary_stat": {
        "icon": "https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/icons/hero_strength.png",
        "name": "Strength"
    },
    "hero_one_liner": "Reflects enemy damage and stuns",
    "small_thumbnail": "https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/heroes/nyx_assassin.png",
    "big_thumbnail": "https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/heroes/renders/nyx_assassin.png",
    "video_thumbnail": "https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/heroes/renders/nyx_assassin.webm",
    "source_link": "https://www.dota2.com/hero/nyxassassin"
}
```
