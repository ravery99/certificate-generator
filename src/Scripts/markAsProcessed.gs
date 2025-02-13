function markAsProcessed(responseId) {
    var cache = CacheService.getScriptCache();
    var cacheKey = "processed_" + responseId;
    cache.put(cacheKey, "done", 600); // Masa cache 10 menit
}