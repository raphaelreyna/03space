.PHONY: dev-run
dev-run:
 	@docker compose up -d
	@sleep 5s
	@xdg-open http://localhost:8081

.PHONY: dev-stop
dev-stop:
	@docker compose stop

.PHONY: dev-clean
dev-clean:
	@docker compose stop
	@rm -f ./dump.rdb