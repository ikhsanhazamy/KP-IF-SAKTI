import urllib.request
import json
import os

with open('extracted_ig_posts.json', 'r', encoding='utf-8') as f:
    posts = json.load(f)

headers = {'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)'}

for i, p in enumerate(posts):
    code = p['code']
    filename = f"backend/storage/app/public/kegiatan/ig-{code}.jpg"
    if not os.path.exists(filename):
        try:
            req = urllib.request.Request(p['display_uri'], headers=headers)
            with urllib.request.urlopen(req) as res:
                data = res.read()
                with open(filename, 'wb') as out:
                    out.write(data)
                print(f"Downloaded [{i+1}] {code} ({len(data)} bytes) -> {filename}")
        except Exception as e:
            print(f"Failed {code}: {e}")
    else:
        print(f"Exists [{i+1}] {code}")
