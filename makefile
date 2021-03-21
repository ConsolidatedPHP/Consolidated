init-vscode:
	make init-env
	cp -r .dev/VSCode/. .

init-env:
	cp .dev/Environment/.env.example .env
