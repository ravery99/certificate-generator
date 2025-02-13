function isAlreadyProcessed(responseId) {
    var cache = CacheService.getScriptCache();
    var cacheKey = "processed_" + responseId;
    return cache.get(cacheKey) !== null;
}